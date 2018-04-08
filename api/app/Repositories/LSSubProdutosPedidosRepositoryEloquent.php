<?php

namespace api\Repositories;

use api\Presenters\LSSubProdutosPedidosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSSubProdutosPedidos;

/**
 * Class LSSubProdutosPedidosRepositoryEloquent
 * @package namespace api\Repositories;
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