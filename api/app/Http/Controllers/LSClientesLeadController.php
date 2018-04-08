<?php

namespace LSAPI\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use LSAPI\Repositories\LSClientesLeadRepository;
use LSAPI\Services\LSClientesLeadService;

class LSClientesLeadController extends Controller {

    /**
     * @var LSClientesLeadRepository
     */
    private $repository;

    /**
     * @var LSClientesLeadService
     */
    private $service;

    /**
     * @param LSClientesLeadRepository $repository
     * @param LSClientesLeadService    $service   
     */
    public function __construct(LSClientesLeadRepository $repository, LSClientesLeadService $service) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function index(Request $request) {
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
        $result = $this->repository->with(['parceiros'])->find($id);
        
        return $result['data'];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search($search_field) {
        $result = $this->repository->search($search_field);

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

}
