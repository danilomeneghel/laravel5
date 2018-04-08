<?php

namespace api\Presenters;

use api\Transformers\LSSubProdutosPedidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSSubProdutosPedidosPresenter
 *
 * @package namespace api\Presenters;
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
