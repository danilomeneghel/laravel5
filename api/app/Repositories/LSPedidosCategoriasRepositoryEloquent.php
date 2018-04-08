<?php

namespace api\Repositories;

use api\Presenters\LSPedidosCategoriasPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSPedidosCategorias;

/**
 * Class LSPedidosCategoriasRepositoryEloquent
 * @package namespace api\Repositories;
 */
class LSPedidosCategoriasRepositoryEloquent extends BaseRepository implements LSPedidosCategoriasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSPedidosCategorias::class;
    }

    public function presenter()
    {
        return LSPedidosCategoriasPresenter::class;
    }
}