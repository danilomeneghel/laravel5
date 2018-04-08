<?php

namespace api\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use api\Repositories\LSTelefonesRepository;
use api\Validators\LSTelefonesValidator;
use api\Entities\LSTelefones;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class LSTelefonesService {

    /**
     * @var LSTelefonesRepository
     */
    private $repository;

    /**
     * @var LSTelefonesValidator
     */
    private $validator;

    /**
     * LSTelefonesService constructor.
     */
    public function __construct(LSTelefonesRepository $repository, LSTelefonesValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) {
        try {
            //Valida os dados
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            return $this->repository->skipPresenter()->create($data);
        } catch (ValidatorException $e) {
            $json = [
                'success' => false,
                'error' => ['message' => $e->getMessageBag()]
            ];
            return response()->json($json, 400);
        }
    }

    public function update(array $data, $id) {
        if (App::make('UserType') == 'admin' || App::make('UserId') == $data['ls_clientes_id']) {
            try {
                //Valida os dados
                $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
                
                //Verifica se existe o ID do telefone
                $telefoneSecundario = $this->repository->skipPresenter()->searchTelefone($id);

                if ($telefoneSecundario->isEmpty()) {
                    $msg['telefone'][] = "Telefone não encontrado.";
                } else {
                    $this->verificarTelefoneExistente($telefoneSecundario);
                    if ($data['telefone'] != $telefoneSecundario[0]['telefone']) {
                        //Atualiza o disabled com a data atual no telefone antigo
                        $this->repository->skipPresenter()->update(['disabled_at' => date('Y-m-d H:i:s')], $id);
                        //Inseri o novo telefone
                        return $this->repository->skipPresenter()->create($data);
                    } else {
                        return $this->repository->skipPresenter()->update($data, $id);
                    }
                }
            } catch (ValidatorException $e) {
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

    public function updateTelefonesDisabled($id) {
        if (App::make('UserType') == 'admin' || App::make('UserId') == $id) {
            try {
                //Atualiza o disabled com a data atual no email antigo
                return LSTelefones::where('ls_clientes_id', '=', $id)->update(['disabled_at' => date('Y-m-d H:i:s')]);
            } catch (ValidatorException $e) {
                $msg = $e->getMessageBag();
            }
        } else {
            $msg['permissao'] = "Sem permissão de acesso!";
        }

        $json = [
            'success' => false,
            'error' => ['message' => $msg]
        ];
        return response()->json($json, 400);
    }

    public function verificarTelefoneExistente($data) {
        //Verifica se já existe o telefone para o mesmo cliente
        $telefoneValido = $this->repository->skipPresenter()->searchTelefones($data)->isEmpty();
        
        if (!$telefoneValido) {
            $msg['telefone'][] = "Cliente com telefone já existente.";
            
            $json = [
                'success' => false,
                'error' => ['message' => $msg]
            ];
            return response()->json($json, 400);
        } else {
            return $telefoneValido;
        }
    }

}
