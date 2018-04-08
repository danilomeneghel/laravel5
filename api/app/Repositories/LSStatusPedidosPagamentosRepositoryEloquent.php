<?php

namespace api\Repositories;

use api\Presenters\LSStatusPedidosPagamentosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSStatusPedidosPagamentos;

/**
 * Class LSStatusPedidosPagamentosRepositoryEloquent
 * @package namespace api\Repositories;
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