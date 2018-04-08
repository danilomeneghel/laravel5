<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 19/10/15
 * Time: 09:42
 */

namespace api\Services;


use api\Repositories\LSPedidosCategoriasRepository;
use api\Validators\LSPedidosCategoriasValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class LSPedidosCategoriasService
{
    /**
     * @var LSPedidosCategoriasRepository
     */
    private $repository;
    /**
     * @var LSPedidosCategoriasValidator
     */
    private $validator;

    /**
     * LSPedidosCategoriasService constructor.
     * @param LSPedidosCategoriasRepository $repository
     * @param LSPedidosCategoriasValidator $validator
     */
    public function __construct(LSPedidosCategoriasRepository $repository, LSPedidosCategoriasValidator $validator)
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