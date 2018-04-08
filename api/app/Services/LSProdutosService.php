<?php

namespace LSAPI\Services;


use LSAPI\Repositories\LSProdutosRepository;
use LSAPI\Validators\LSProdutosValidator;
use \Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class LSProdutosService
{
    /**
     * @var LSProdutosRepository
     */
    private $repository;
    /**
     * @var LSProdutosValidator
     */
    private $validator;

    /**
     * LSProdutosService constructor.
     * @param LSProdutosRepository $repository
     * @param LSProdutosValidator $validator
     */
    public function __construct(LSProdutosRepository $repository, LSProdutosValidator $validator)
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
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
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
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function delete($id)
    {
        try {
            $data['disabled_at'] = date('Y-m-d H:i:s');
            return $this->repository->update($data, $id);
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