<?php

namespace api\Presenters;

use api\Transformers\LSProdutosPedidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSProdutosPedidosPresenter
 *
 * @package namespace api\Presenters;
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
