<?php

namespace LSAPI\Http\Controllers;

use Illuminate\Http\Request;
use LSAPI\Http\Requests;
use LSAPI\Http\Controllers\Controller;
use LSAPI\Repositories\LSProdutosRepository;
use LSAPI\Services\LSProdutosService;

class LSProdutosController extends Controller
{
    /**
     * @var LSProdutosRepository
     */
    private $repository;
    /**
     * @var LSProdutosService
     */
    private $service;

    /**
     * LSProdutosController constructor.
     * @param LSProdutosRepository $repository
     * @param LSProdutosService $service
     */
    public function __construct(LSProdutosRepository $repository, LSProdutosService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @return mixed
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
     * @param param $fontId
     * @return mixed
     */
    public function searchFont($fontId) {
        $result = $this->repository->searchFont($fontId);
        return $result;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchSlug($slug)
    {
        return $this->repository->findWhere(['slug' => $slug]);
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
        //$id = (int)$id;
        return $this->service->delete($id);
    }
}
