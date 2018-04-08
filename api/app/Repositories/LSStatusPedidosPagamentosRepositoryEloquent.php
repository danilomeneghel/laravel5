<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSStatusPedidosPagamentosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSStatusPedidosPagamentos;

/**
 * Class LSStatusPedidosPagamentosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSStatusPedidosPagamentosRepositoryEloquent extends BaseRepository implements LSStatusPedidosPagamentosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSStatusPedidosPagamentos::class;
    }

    public function presenter()
    {
        return LSStatusPedidosPagamentosPresenter::class;
    }
}