<?php

namespace api\Repositories;

use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSContasRobos;
use api\Entities\LSContasMetaTrader;
use api\Entities\LSPedidos;
use api\Entities\LSClientes;
use api\Entities\LSProdutos;
use api\Entities\LSMetodosPagamentos;
use api\Presenters\LSContasRobosPresenter;
use api\Presenters\LSContasMetaTraderPresenter;
use api\Presenters\LSPedidosPresenter;

/**
 * Class LSContasRobosRepositoryEloquent
 * @package namespace api\Repositories;
 */
class LSContasRobosRepositoryEloquent extends BaseRepository implements LSContasRobosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSContasRobos::class;
        return LSContasMetaTrader::class;
        return LSPedidos::class;
        return LSClientes::class;
        return LSProdutos::class;
        return LSMetodosPagamentos::class;
    }

    public function presenter() {
        return LSContasRobosPresenter::class;
        return LSContasMetaTraderPresenter::class;
        return LSPedidosPresenter::class;
    }

    public function search($search_field)
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSContasRobos::where(function ($query) use ($search_field) {
            $query->where('ativos', 'ilike', "%$search_field%");
            $query->whereNull('disabled_at');
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