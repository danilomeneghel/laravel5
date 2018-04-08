<?php

namespace api\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use api\Repositories\LSClientesLeadRepository;
use api\Validators\LSClientesLeadValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class LSClientesLeadService {

    /**
     * @var LSClientesLeadRepository
     */
    private $repository;

    /**
     * @var LSClientesLeadValidator
     */
    private $validator;

    /**
     * LSClientesLeadService constructor.
     * @param LSClientesLeadRepository $repository
     * @param LSClientesLeadValidator $validator
     */
    public function __construct(LSClientesLeadRepository $repository, LSClientesLeadValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) {
        try {
            $this->validator->with($data)->passesOrFail();
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
                $this->validator->with($data)->passesOrFail();
                return $this->repository->skipPresenter()->update($data, $id);
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

}
