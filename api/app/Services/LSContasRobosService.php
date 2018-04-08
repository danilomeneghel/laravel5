<?php

namespace LSAPI\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use LSAPI\Repositories\LSContasRobosRepository;
use LSAPI\Validators\LSContasRobosValidator;
use LSAPI\Entities\LSContasRobos;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class LSContasRobosService {

    /**
     * @var LSContasRobosRepository
     */
    private $repository;

    /**
     * @var LSContasRobosValidator
     */
    private $validator;

    /**
     * LSContasRobosService constructor.
     */
    public function __construct(LSContasRobosRepository $repository, LSContasRobosValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) {
        try {
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
        try {
            //Valida os dados
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            return $this->repository->skipPresenter()->update($data, $id);
        } catch (ValidatorException $e) {
            $msg = $e->getMessageBag();
        }

        $json = [
            'success' => false,
            'error' => ['message' => $msg]
        ];
        return response()->json($json, 400);
    }

}
