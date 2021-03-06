<?php

namespace api\Repositories;

use api\Presenters\LSMetodosPagamentosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSMetodosPagamentos;

/**
 * Class LSMetodosPagamentosRepositoryEloquent
 * @package namespace api\Repositories;
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