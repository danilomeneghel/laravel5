<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSProdutosPedidosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSProdutosPedidos;

/**
 * Class LSProdutosPedidosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSProdutosPedidosRepositoryEloquent extends BaseRepository implements LSProdutosPedidosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSProdutosPedidos::class;
    }

    public function presenter()
    {
        return LSProdutosPedidosPresenter::class;
    }
}