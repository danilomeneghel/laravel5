<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSProdutosPedidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSProdutosPedidosPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSProdutosPedidosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSProdutosPedidosTransformer();
    }
}
