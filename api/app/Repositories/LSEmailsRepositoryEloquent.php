<?php

namespace LSAPI\Repositories;

use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSEmails;

/**
 * Class LSEmailsRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSEmailsRepositoryEloquent extends BaseRepository implements LSEmailsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSEmails::class;
    }

    public function search($search_field)
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSEmails::where(function ($query) use ($search_field) {
            $query->where('email', 'ilike', "%$search_field%");
            $query->whereNull('disabled_at');
        })
        ->paginate(24);
        return $this->parserResult($result);
    }
    
    public function searchEmail($search_field)
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSEmails::where(function ($query) use ($search_field) {
            $query->where('id', '=', $search_field);
            $query->whereNull('disabled_at');
        })
        ->paginate(24);
        return $this->parserResult($result);
    }

    public function emailSecundarioOutroUsuario($id, $data)
    {
        $result = LSEmails::where(function ($query) use ($id, $data) {
            $query->where('ls_clientes_id', '!=', $id);
            $query->where('email', '=', $data['email']);
            $query->whereNull('disabled_at');
        })
        ->paginate(24)->isEmpty();
        return $result;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }
}