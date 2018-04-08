<?php

namespace LSAPI\Services;

use LSAPI\Repositories\UserRepository;
use LSAPI\Validators\UserValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserService {

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserValidator
     */
    private $validator;

    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $repository, UserValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data['password'] = bcrypt($data['password']);
            return $this->repository->skipPresenter()->create($data);
        } catch (ValidatorException $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'error_type' => '',
                    'message' => $e->getMessageBag(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    public function update(array $data, $id) {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            return $this->repository->skipPresenter()->update($data, $id);
        } catch (ValidatorException $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'error_type' => '',
                    'message' => $e->getMessageBag(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

}
