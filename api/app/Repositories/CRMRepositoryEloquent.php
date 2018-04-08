<?php

namespace LSAPI\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use LSAPI\Entities\CRM;

/**
 * Class CRMRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class CRMRepositoryEloquent extends BaseRepository implements CRMRepository {

    public function model() {
        return CRM::class;
    }

}
