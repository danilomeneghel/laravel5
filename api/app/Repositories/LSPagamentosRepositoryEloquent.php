<?php

namespace api\Repositories;

use api\Presenters\LSPagamentosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSPagamentos;

/**
 * Class LSPagamentosRepositoryEloquent
 * @package namespace api\Repositories;
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