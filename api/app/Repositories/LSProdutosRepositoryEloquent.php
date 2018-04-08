<?php

namespace LSAPI\Repositories;

use LSAPI\Presenters\LSProdutosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSProdutos;

/**
 * Class LSProdutosRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSProdutosRepositoryEloquent extends BaseRepository implements LSProdutosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LSProdutos::class;
    }

    public function presenter()
    {
        return LSProdutosPresenter::class;
    }

    public function search($search_field)
    {
        $result = LSProdutos::where(function ($query) use ($search_field) {
            $query->where('nome', 'ilike', "%$search_field%");
            //$query->orWhere('codigo_origem_produto', '=', $search_field);
            $query->whereNull('disabled_at');
        })
        ->paginate(24);
        return $this->parserResult($result);
    }
    
    public function searchFont($fontId)
    {
        $result = LSProdutos::where('ls_fontes_id', '=', $fontId)
                            ->whereNull('disabled_at')
                            ->paginate(24);
        return $result;
    }
    
}