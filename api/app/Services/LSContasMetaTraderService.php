<?php

namespace api\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use api\Repositories\LSContasMetaTraderRepository;
use api\Repositories\LSContasRobosRepository;
use api\Validators\LSContasMetaTraderValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class LSContasMetaTraderService {

    /**
     * @var LSContasMetaTraderRepository
     */
    private $repository;

    /**
     * @var LSContasRobosRepository
     */
    private $robosRepository;

    /**
     * @var LSContasMetaTraderValidator
     */
    private $validator;

    /**
     * LSContasMetaTraderService constructor.
     */
    public function __construct(LSContasMetaTraderRepository $repository, LSContasRobosRepository $robosRepository, LSContasMetaTraderValidator $validator) {
        $this->repository = $repository;
        $this->robosRepository = $robosRepository;
        $this->validator = $validator;
    }

    public function create(array $data) {
        DB::beginTransaction();
        try {
            //Valida os dados
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            $find = "";
            //Verifica se a conta já está cadastrada para o mesmo robo
            $data2 = $this->repository->skipPresenter()->findWhere(['conta_real' => $data['conta_real']])->isEmpty();
            if(!$data2)
                $find = $this->robosRepository->skipPresenter()->findWhere(['ls_produtos_id' => $data['ls_produtos_id']]);
            
            //Caso não esteja cadastrada, inseri o novo dado
            if(empty($find)) {
                $contaMetaTrader = $this->repository->skipPresenter()->create($data);
                if(!empty($contaMetaTrader->id)) {
                    $data['ls_contas_meta_trader_id'] = $contaMetaTrader->id;
                    $contaRobo = $this->robosRepository->skipPresenter()->create($data);

                    //Caso de tudo certo salva os dados no banco de dados
                    DB::commit();

                    $result = array_merge($contaMetaTrader['attributes'], $contaRobo['attributes']);

                    return $result;
                }
            } else {
                $json = [
                    'success' => false,
                    'error' => ['message' => 'Cadastro já realizado para esse robo.']
                ];
                return response()->json($json, 200);
            }
        } catch (ValidatorException $e) {
            //Se der algum erro faz o rollbak e não deixa salvar nada no banco de dados
            DB::rollBack();
            $msg = $e->getMessageBag();
        }
        $json = [
            'success' => false,
            'error' => ['message' => $msg]
        ];
        return response()->json($json, 400);
    }

    public function update(array $data, $id) {
        if (App::make('UserType') == 'admin' || App::make('UserId') == $data['ls_clientes_id']) {
            DB::beginTransaction();
            try {
                //Valida os dados
                $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
                
                $contaMetaTrader = $this->repository->skipPresenter()->update($data, $id);
                
                //Localiza o robo do cliente para depois atualizar os dados
                $resultRobo = $this->robosRepository->findWhere(['ls_clientes_id' => $data['ls_clientes_id']]);
                if ($resultRobo->isEmpty()) {
                    $data['ls_contas_meta_trader_id'] = $id;
                    $contaRobo = $this->robosRepository->skipPresenter()->update($data, $resultRobo[0]['id']);
                }
                
                //Caso de tudo certo salva os dados no banco de dados
                DB::commit();

                $result = array_merge($contaMetaTrader['attributes'], $contaRobo['attributes']);

                return $result;
            } catch (ValidatorException $e) {
                //Se der algum erro faz o rollbak e não deixa salvar nada no banco de dados
                DB::rollBack();
                $msg = $e->getMessageBag();
            }
        } else {
            $msg['permissao'] = 'Sem permissão de acesso!';
        }

        $json = [
            'success' => false,
            'error' => ['message' => $msg]
        ];
        return response()->json($json, 400);
    }

}
