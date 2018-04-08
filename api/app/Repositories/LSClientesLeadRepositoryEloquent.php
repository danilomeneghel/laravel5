<?php

namespace api\Repositories;

use api\Presenters\LSClientesLeadPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSClientesLead;

/**
 * Class LSClientesLeadRepositoryEloquent
 * @package namespace api\Repositories;
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