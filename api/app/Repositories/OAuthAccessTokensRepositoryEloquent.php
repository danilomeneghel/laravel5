<?php

namespace api\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\OAuthAccessTokens;

/**
 * Class OAuthAccessTokensRepositoryEloquent
 * @package namespace api\Repositories;
 */
class OAuthAccessTokensRepositoryEloquent extends BaseRepository implements OAuthAccessTokensRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OAuthAccessTokens::class;
    }

}