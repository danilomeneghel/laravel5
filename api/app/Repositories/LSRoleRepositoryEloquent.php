<?php

namespace api\Repositories;

use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSRoles;

/**
 * Class LSRolesRepositoryEloquent
 * @package namespace api\Repositories;
 */
class LSRolesRepositoryEloquent extends BaseRepository implements LSRolesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSRoles::class;
    }

    public function search($search_field)
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSRoles::where(function ($query) use ($search_field) {
            $query->where('name', 'ilike', "%$search_field%");
        })
        ->paginate(24);
        return $this->parserResult($result);
    }
    
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }
}