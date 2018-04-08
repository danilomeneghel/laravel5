<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 19/10/15
 * Time: 09:27
 */

namespace api\Services;


use api\Repositories\LSSubProdutosPedidosRepository;
use api\Validators\LSSubProdutosPedidosValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class LSSubProdutosPedidosService
{
    /**
     * @var LSSubProdutosPedidosRepository
     */
    private $repository;
    /**
     * @var LSSubProdutosPedidosValidator
     */
    private $validator;

    /**
     * LSSubProdutosPedidosService constructor.
     * @param LSSubProdutosPedidosRepository $repository
     * @param LSSubProdutosPedidosValidator $validator
     */
    public function __construct(LSSubProdutosPedidosRepository $repository, LSSubProdutosPedidosValidator $validator)
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