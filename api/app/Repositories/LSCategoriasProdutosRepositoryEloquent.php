<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSCategoriasProdutosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSCategoriasProdutos;

/**
 * Class LSCategoriasProdutosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
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