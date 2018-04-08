<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 19/10/15
 * Time: 09:30
 */

namespace LSAPI\Services;


use LSAPI\Repositories\LSPagamentosRepository;
use LSAPI\Validators\LSPagamentosValidator;
use \Prettus\Validator\Exceptions\ValidatorException;

class LSPagamentosService
{
    /**
     * @var LSPagamentosRepository
     */
    private $repository;
    /**
     * @var LSPagamentosValidator
     */
    private $validator;

    /**
     * LSPagametosService constructor.
     * @param LSPagamentosRepository $repository
     * @param LSPagamentosValidator $validator
     */
    public function __construct(LSPagamentosRepository $repository, LSPagametosValidator $validator)
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