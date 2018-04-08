<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSMetodosPagamentosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSMetodosPagamentos;

/**
 * Class LSMetodosPagamentosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSMetodosPagamentosRepositoryEloquent extends BaseRepository implements LSMetodosPagamentosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSMetodosPagamentos::class;
    }

    public function presenter()
    {
        return LSMetodosPagamentosPresenter::class;
    }
}