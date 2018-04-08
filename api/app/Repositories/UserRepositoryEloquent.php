<?php

namespace LSAPI\Repositories;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;
use LSAPI\Presenters\UserPresenter;
use LSAPI\Transformers\UserTransformer;
use Prettus\Repository\Eloquent\BaseRepository;
use LSAPI\Entities\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function presenter()
    {
        return UserPresenter::class;
    }

    /**
     * @param $search
     */
    public function search( $search_field )
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = User::where( function ( $query2 ) use ( $search_field ) {
                        $query2->where( 'name', 'ilike', "%$search_field%" );
                        $query2->orWhere('email', 'ilike', "%$search_field%" );
                    })
                    ->paginate(24);
        return $this->parserResult($result);
    }
}
