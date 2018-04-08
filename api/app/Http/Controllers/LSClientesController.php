<?php

namespace api\Http\Controllers;

use Illuminate\Support\Facades\App;
use api\Repositories\LSClientesRepository;
use api\Services\LSClientesService;
use Illuminate\Http\Request;
use api\Entities\LSClientes;

class LSClientesController extends Controller {

    /**
     * @var LSClientesRepository
     */
    private $repository;

    /**
     * @var LSClientesService
     */
    private $service;

    /**
     * @param LSClientesRepository $repository
     * @param LSClientesService    $service   
     */
    public function __construct(LSClientesRepository $repository, LSClientesService $service) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function index(Request $request) {
        $result = LSClientes::paginate(24);
                
        foreach ($result as $key => $cliente) {
            $lslive = $this->repository->get_lslive($cliente['id']);
            if (!$lslive)
                $result[$key]['acesso_lslive'] = true;
            else
                $result[$key]['acesso_lslive'] = false;
        }

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        return $this->service->create($request->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(Request $request, $id) {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $result = $this->repository->with(['pedidos' => function($query) {
            $query->with(['pagamentos' => function($query) {
                    $query->with('metodo_pagamento');
                }]);
            $query->with(['produtos' => function($query) {
                    $query->with('produto');
                }]);
        }, 'emails', 'telefones', 'enderecos'])->find($id);
                
        return $result['data'];
    }

    public function logged() {
        if (!is_null(App::make('UserId'))) {
            $result = $this->repository->find(App::make('UserId'));

            $lslive = $this->repository->get_lslive($result['data']['id']);
            if (!$lslive)
                $result['data']['acesso_lslive'] = true;
            else
                $result['data']['acesso_lslive'] = false;

            return $result;
        } else {
            $json = [
                'success' => false,
                'error' => ['message' => 'Sem permissão de acesso!']
            ];
            return response()->json($json, 400);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search($search_field) {
        $result = $this->repository->search($search_field);

        foreach ($result['data'] as $key => $cliente) {
            $lslive = $this->repository->get_lslive($cliente['id']);
            if (!$lslive)
                $result['data'][$key]['acesso_lslive'] = true;
            else
                $result['data'][$key]['acesso_lslive'] = false;
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchCpfCnpj($search_field) {
        $result = $this->repository->searchCpfCnpj($search_field);
        return $result;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        return $this->repository->delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function pedidos($id) {
        return $this->repository->pedidos($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update_lslive(Request $request, $id) {
        return $this->service->update_lslive($request->all(), $id);
    }
    
    /**
     * @param $id
     * @return mixed
     */
    public function update_senha(Request $request, $id) {
        return $this->service->update_senha($request->all(), $id);
    }

}
