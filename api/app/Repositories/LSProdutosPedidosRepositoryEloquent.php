<?php

namespace api\Repositories;

use api\Presenters\LSProdutosPedidosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSProdutosPedidos;

/**
 * Class LSProdutosPedidosRepositoryEloquent
 * @package namespace api\Repositories;
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