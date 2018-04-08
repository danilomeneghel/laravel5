<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSSubProdutosPedidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSSubProdutosPedidosPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSSubProdutosPedidosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSSubProdutosPedidosTransformer();
    }
}
