<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSSubProdutosPedidosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSSubProdutosPedidos;

/**
 * Class LSSubProdutosPedidosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSSubProdutosPedidosRepositoryEloquent extends BaseRepository implements LSSubProdutosPedidosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSSubProdutosPedidos::class;
    }

    public function presenter()
    {
        return LSSubProdutosPedidosPresenter::class;
    }
}