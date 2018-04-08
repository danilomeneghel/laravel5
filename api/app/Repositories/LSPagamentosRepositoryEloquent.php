<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSPagamentosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSPagamentos;

/**
 * Class LSPagamentosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSPagamentosRepositoryEloquent extends BaseRepository implements LSPagamentosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSPagamentos::class;
    }

    public function presenter()
    {
        return LSPagamentosPresenter::class;
    }
}