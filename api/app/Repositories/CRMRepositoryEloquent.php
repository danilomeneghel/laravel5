<?php

namespace api\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use api\Entities\CRM;

/**
 * Class CRMRepositoryEloquent
 * @package namespace api\Repositories;
 */
class CRMRepositoryEloquent extends BaseRepository implements CRMRepository {

    public function model() {
        return CRM::class;
    }

}
