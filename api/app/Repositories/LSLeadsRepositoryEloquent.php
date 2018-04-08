<?php

namespace LSAPI\Repositories;

use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSLeads;

/**
 * Class LSLeadsRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSLeadsRepositoryEloquent extends BaseRepository implements LSLeadsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSLeads::class;
    }

    public function search($search_field)
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSLeads::where(function ($query) use ($search_field) {
            $query->where('nome', 'ilike', "%$search_field%");
            $query->where('cpf', '=', "$search_field");
            $query->where('email', 'ilike', "%$search_field%");
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