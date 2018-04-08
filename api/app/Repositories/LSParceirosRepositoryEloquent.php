<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSParceirosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSParceiros;

/**
 * Class LSParceirosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSParceirosRepositoryEloquent extends BaseRepository implements LSParceirosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSParceiros::class;
    }

    public function presenter()
    {
        return LSParceirosPresenter::class;
    }
}