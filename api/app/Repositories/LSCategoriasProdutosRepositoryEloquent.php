<?php

namespace api\Repositories;

use api\Presenters\LSCategoriasProdutosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSCategoriasProdutos;

/**
 * Class LSCategoriasProdutosRepositoryEloquent
 * @package namespace api\Repositories;
 */
class LSCategoriasProdutosRepositoryEloquent extends BaseRepository implements LSCategoriasProdutosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSCategoriasProdutos::class;
    }

    public function presenter()
    {
        return LSCategoriasProdutosPresenter::class;
    }
}