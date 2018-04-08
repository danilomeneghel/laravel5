<?php

namespace LSAPI\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use LSAPI\Http\Requests;
use LSAPI\Http\Controllers\Controller;
use LSAPI\Repositories\LSPedidosRepository;
use LSAPI\Services\LSPedidosService;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSPedidos;

class LSPedidosController extends Controller
{
    /**
     * @var LSPedidosRepository
     */
    private $repository;
    /**
     * @var LSPedidosService
     */
    private $service;

    /**
     * LSPedidosController constructor.
     * @param LSPedidosRepository $repository
     * @param LSPedidosService $service
     */
    public function __construct(LSPedidosRepository $repository, LSPedidosService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->skipPresenter()->with(['status_pedido_pagamento' => function($query){
                    $query->with('status')->orderBy('created_at','desc');                    
                }, 'pagamentos' => function($query) {
                    $query->with('metodo_pagamento');
                }, 'categoria', 'descontos', 'clientes', 'enderecos'])
                ->scopeQuery(function($query) {
                    return $query->orderBy('created_at','desc');
                })->paginate(24);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->skipPresenter()->with(['status_pedido_pagamento' => function($query){
            $query->with('status')->orderBy('created_at','desc');
        }, 'produtos' => function($query){
            $query->with('produto');
        }, 'pagamentos' => function($query) {
            $query->with('metodo_pagamento');
        }, 'categoria', 'descontos', 'clientes', 'enderecos'])->find($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchAdvanced($search_field, $tipo_busca)
    {
        return $this->repository->searchAdvanced($search_field, $tipo_busca)->paginate(24);
    }
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function searchPedidoCliente($cliente_id, $status_id, $fonte_id)
    {
        return $this->repository->searchPedidoCliente($cliente_id, $status_id, $fonte_id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
