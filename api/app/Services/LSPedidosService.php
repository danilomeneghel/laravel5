<?php

namespace api\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use api\Repositories\LSPedidosRepository;
use api\Repositories\LSProdutosPedidosRepository;
use api\Repositories\LSStatusPedidosPagamentosRepository;
use api\Validators\LSPedidosValidator;
use api\Validators\LSProdutosPedidosValidator;
use api\Validators\LSStatusPedidosPagamentosValidator;
use api\Entities\LSPedidos;
use api\Entities\LSProdutosPedidos;
use api\Entities\LSStatusPedidosPagamentos;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class LSPedidosService {

    /**
     * @var LSPedidosRepository
     */
    private $repository;

    /**
     * @var LSProdutosPedidosRepository
     */
    private $repositoryProdutosPedidos;

    /**
     * @var LSStatusPedidosPagamentosRepository
     */
    private $repositoryStatusPedidosPagamentos;

    /**
     * @var LSPedidosValidator
     */
    private $validator;

    /**
     * @var LSProdutosPedidosValidator
     */
    private $validatorProdutosPedidos;

    /**
     * @var LSStatusPedidosPagamentosValidator
     */
    private $validatorStatusPedidosPagamentos;

    /**
     * LSPedidosService constructor.
     */
    public function __construct(LSPedidosRepository $repository, LSProdutosPedidosRepository $repositoryProdutosPedidos, LSStatusPedidosPagamentosRepository $repositoryStatusPedidosPagamentos, LSPedidosValidator $validator, LSProdutosPedidos $validatorProdutosPedidos, LSStatusPedidosPagamentos $validatorStatusPedidosPagamentos) {
        $this->repository = $repository;
        $this->repositoryProdutosPedidos = $repositoryProdutosPedidos;
        $this->repositoryStatusPedidosPagamentos = $repositoryStatusPedidosPagamentos;
        $this->validator = $validator;
        $this->validatorProdutosPedidos = $validatorProdutosPedidos;
        $this->validatorStatusPedidosPagamentos = $validatorStatusPedidosPagamentos;
    }

    public function create(array $data) {
        $msg = "";

        DB::beginTransaction();
        try {
            //Valida os dados
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            //Salva os dados na tabela ls_pedidos
            $pedido = $this->repository->skipPresenter()->create($data);

            if (!empty($pedido->id)) {
                //$this->validatorProdutosPedidos->with($data)->passesOrFail();
                //Salva os dados na tabela ls_produtos_pedidos
                $dataProdutoPedido['ls_pedidos_id'] = $pedido->id;
                $dataProdutoPedido['ls_produtos_id'] = (int) $data['ls_produtos_id'];
                $dataProdutoPedido['preco'] = (int) $data['preco'];
                $dataProdutoPedido['quantidade'] = (int) $data['quantidade'];
                $produtoPedido = $this->repositoryProdutosPedidos->skipPresenter()->create($dataProdutoPedido);

                //$this->validatorStatusPedidosPagamentos->with($data)->passesOrFail();
                //Salva os dados na tabela ls_status_pedidos_pagamentos
                $dataStatusPedidoPag['ls_pedidos_id'] = $pedido->id;
                $dataStatusPedidoPag['ls_status_id'] = $data['ls_status_id'];
                $statusPedidoPagamento = $this->repositoryStatusPedidosPagamentos->skipPresenter()->create($dataStatusPedidoPag);
            }

            //Caso de tudo certo salva os dados no banco de dados
            DB::commit();

            //Retira o ID das outras tabelas de ligação para não dar confusão ao dar o merge
            unset($produtoPedido['id']);
            unset($statusPedidoPagamento['id']);
            
            $result = array_merge($pedido['attributes'], $produtoPedido['attributes'], $statusPedidoPagamento['attributes']);

            return $result;
        } catch (ValidatorException $e) {
            //Se der algum erro faz o rollbak e não deixa salvar nada no banco de dados
            DB::rollBack();
            $msg = $e->getMessageBag();
        }
        $json = [
            'success' => false,
            'error' => ['message' => $msg]
        ];
        return response()->json($json, 400);
    }

}
