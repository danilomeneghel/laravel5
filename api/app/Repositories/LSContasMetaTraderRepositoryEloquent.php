<?php

namespace LSAPI\Repositories;

use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSContasMetaTrader;
use LSAPI\Entities\LSContasRobos;
use LSAPI\Presenters\LSContasMetaTraderPresenter;
use LSAPI\Presenters\LSContasRobosPresenter;

/**
 * Class LSContasMetaTraderRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSContasMetaTraderRepositoryEloquent extends BaseRepository implements LSContasMetaTraderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() {
        return LSContasMetaTrader::class;
        return LSContasRobos::class;        
    }

    public function presenter() {
        return LSContasMetaTraderPresenter::class;
        return LSContasRobosPresenter::class;
    }
    
    public function search($search_field)
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSContasMetaTrader::where(function ($query) use ($search_field) {
            $query->where('nome', 'ilike', "%$search_field%");
            $query->orWhere('conta_real', '=', $search_field);
            $query->whereNull('disabled_at');
        })
        ->paginate(24);
        return $this->parserResult($result);
    }
    
    public function useRobot($conta)
    {
        $result = LSContasMetaTrader::where(function ($query) use ($conta) {
            $query->where('conta_real', '=', $conta);
            //$query->whereNull('disabled_at');
        })->paginate(24);

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