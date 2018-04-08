<?php

namespace LSAPI\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use LSAPI\Repositories\LSEmailsRepository;
use LSAPI\Validators\LSEmailsValidator;
use LSAPI\Entities\LSEmails;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class LSEmailsService {

    /**
     * @var LSEmailsRepository
     */
    private $repository;

    /**
     * @var LSEmailsValidator
     */
    private $validator;

    /**
     * LSEmailsService constructor.
     */
    public function __construct(LSEmailsRepository $repository, LSEmailsValidator $validator) {
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
                
                //Verifica se existe o ID do e-mail
                $emailSecundario = $this->repository->skipPresenter()->searchEmail($id);

                if ($emailSecundario->isEmpty()) {
                    $msg['email'][] = "E-mail não encontrado.";
                } else {
                    if ($data['email'] != $emailSecundario[0]['email']) {
                        //Atualiza o disabled com a data atual no email antigo
                        $this->repository->skipPresenter()->update(['disabled_at' => date('Y-m-d H:i:s')], $id);
                        //Inseri o novo email
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

    public function updateEmailsDisabled($id) {
        if (App::make('UserType') == 'admin' || App::make('UserId') == $id) {
            try {
                //Atualiza o disabled com a data atual no email antigo
                return LSEmails::where('ls_clientes_id', '=', $id)->update(['disabled_at' => date('Y-m-d H:i:s')]);
            } catch (ValidatorException $e) {
                $msg = $e->getMessageBag();
            }
        } else {
            $msg = "Sem permissão de acesso!";
        }

        $json = [
            'success' => false,
            'error' => ['message' => $msg]
        ];
        return response()->json($json, 400);
    }

}
