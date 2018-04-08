<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSDescontosPedidosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSDescontosPedidos;

/**
 * Class LSDescontosPedidosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
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