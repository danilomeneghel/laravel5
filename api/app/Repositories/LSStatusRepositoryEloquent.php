<?php

namespace api\Repositories;

use api\Presenters\LSStatusPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSStatus;

/**
 * Class LSStatusRepositoryEloquent
 * @package namespace api\Repositories;
 */
class LSStatusRepositoryEloquent extends BaseRepository implements LSStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSStatus::class;
    }

    public function presenter()
    {
        return LSStatusPresenter::class;
    }
}