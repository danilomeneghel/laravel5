<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSClientesLeadPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSClientesLead;

/**
 * Class LSClientesLeadRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSClientesLeadRepositoryEloquent extends BaseRepository implements LSClientesLeadRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSClientesLead::class;
    }

    public function presenter()
    {
        return LSClientesLeadPresenter::class;
    }
}