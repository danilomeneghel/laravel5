<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 19/10/15
 * Time: 09:36
 */

namespace api\Services;


use api\Repositories\LSCategoriasProdutosRepository;
use api\Validators\LSCategoriasProdutosValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class LSCategoriasProdutosService
{
    /**
     * @var LSCategoriasProdutosRepository
     */
    private $repository;
    /**
     * @var LSCategoriasProdutosValidator
     */
    private $validator;

    /**
     * LSCategoriasProdutosService constructor.
     * @param LSCategoriasProdutosRepository $repository
     * @param LSCategoriasProdutosValidator $validator
     */
    public function __construct(LSCategoriasProdutosRepository $repository, LSCategoriasProdutosValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

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