<?php

namespace api\Repositories;

use api\Presenters\LSDescontosPedidosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSDescontosPedidos;

/**
 * Class LSDescontosPedidosRepositoryEloquent
 * @package namespace api\Repositories;
 */
class LSDescontosPedidosRepositoryEloquent extends BaseRepository implements LSDescontosPedidosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSDescontosPedidos::class;
    }

    public function presenter()
    {
        return LSDescontosPedidosPresenter::class;
    }
}