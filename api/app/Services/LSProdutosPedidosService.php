<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 17/10/15
 * Time: 19:21
 */

namespace api\Services;


use api\Repositories\LSProdutosPedidosRepository;
use api\Validators\LSProdutosPedidosValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class LSProdutosPedidosService
{
    /**
     * @var LSProdutosPedidosRepository
     */
    private $repository;
    /**
     * @var LSProdutosPedidosValidator
     */
    private $validator;

    /**
     * @param LSProdutosPedidosRepository $repository
     * @param LSProdutosPedidosValidator $validator
     */
    public function __construct(LSProdutosPedidosRepository $repository, LSProdutosPedidosValidator $validator)
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