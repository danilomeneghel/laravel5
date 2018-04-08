<?php

namespace api\Http\Controllers;

use Illuminate\Http\Request;
use api\Http\Requests;
use api\Http\Controllers\Controller;
use api\Repositories\LSStatusPedidosPagamentosRepository;
use api\Services\LSStatusPedidosPagamentosService;

class LSStatusPedidosPagamentosController extends Controller
{
    /**
     * @var LSStatusPedidosPagamentosRepository
     */
    private $repository;
    /**
     * @var LSStatusPedidosPagamentosService
     */
    private $service;

    /**
     * LSStatusPedidosPagamentosController constructor.
     * @param LSStatusPedidosPagamentosRepository $repository
     * @param LSStatusPedidosPagamentosService $service
     */
    public function __construct(LSStatusPedidosPagamentosRepository $repository, LSStatusPedidosPagamentosService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->repository->paginate(24);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function logged()
    {
        if( !is_null(App::make('UserId'))) {
            return $this->repository->find(App::make('UserId')->id);
        }
        return [];
    }
    /**
     * @param Request $request
     * @return mixed
     */
    public function search($search_field)
    {
        return $this->repository->search($search_field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
