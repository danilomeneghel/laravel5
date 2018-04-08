<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSPedidosCategoriasPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSPedidosCategorias;

/**
 * Class LSPedidosCategoriasRepositoryEloquent
 * @package namespace LSAPI\Repositories;
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