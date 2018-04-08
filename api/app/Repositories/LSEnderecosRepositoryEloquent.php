<?php

namespace LSAPI\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSEnderecos;

/**
 * Class LSEnderecosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSEnderecosRepositoryEloquent extends BaseRepository implements LSEnderecosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSEnderecos::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }
}