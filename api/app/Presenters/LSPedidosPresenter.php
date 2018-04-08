<?php

namespace api\Presenters;

use api\Transformers\LSPedidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPedidosPresenter
 *
 * @package namespace api\Presenters;
 */
class LSPedidosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSPedidosTransformer();
    }
}
