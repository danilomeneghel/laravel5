<?php

namespace api\Repositories;

use api\Presenters\LSParceirosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSParceiros;

/**
 * Class LSParceirosRepositoryEloquent
 * @package namespace api\Repositories;
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