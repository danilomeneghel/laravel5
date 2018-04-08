<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSStatusPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSStatus;

/**
 * Class LSStatusRepositoryEloquent
 * @package namespace LSAPI\Repositories;
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