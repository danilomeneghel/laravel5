<?php

namespace LSAPI\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\OAuthAccessTokens;

/**
 * Class OAuthAccessTokensRepositoryEloquent
 * @package namespace LSAPI\Repositories;
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