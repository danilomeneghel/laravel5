<?php

namespace api\Http\Controllers;

use Illuminate\Http\Request;
use api\Repositories\LSEnderecosRepository;
use api\Http\Controllers\Controller;
use api\Services\LSEnderecosService;

class LSEnderecosController extends Controller
{
    /**
     * @var LSEnderecosRepository
     */
    private $repository;
    /**
     * @var LSEnderecosService
     */
    private $service;

    /**
     * LSEnderecosController constructor.
     */
    public function __construct(LSEnderecosRepository $repository, LSEnderecosService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->scopeQuery(function($query){
            return $query->orderBy('id');
        })->paginate(24);
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
