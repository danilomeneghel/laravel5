<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 17/10/15
 * Time: 19:32
 */

namespace LSAPI\Services;


use LSAPI\Repositories\LSDescontosPedidosRepository;
use LSAPI\Validators\LSDescontosPedidosValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class LSDescontosPedidosService
{
    /**
     * @var LSDescontosPedidosRepository
     */
    private $repository;
    /**
     * @var LSDescontosPedidosValidator
     */
    private $validator;

    /**
     * LSDescontosPedidosService constructor.
     * @param LSDescontosPedidosRepository $repository
     * @param LSDescontosPedidosValidator $validator
     */
    public function __construct(LSDescontosPedidosRepository $repository, LSDescontosPedidosValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->skipPresenter()->create($data);
        } catch(ValidatorException $e) {
            $json = [
                'success' => false,
                'error'   => [
                    'code'          => $e->getCode(),
                    'error_type'    => '',
                    'message'       => $e->getMessageBag(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->skipPresenter()->update($data, $id);
        } catch(ValidatorException $e) {
            $json = [
                'success' => false,
                'error'   => [
                    'code'          => $e->getCode(),
                    'error_type'    => '',
                    'message'       => $e->getMessageBag(),
                ],
            ];

            return response()->json($json, 400);
        }
    }
}