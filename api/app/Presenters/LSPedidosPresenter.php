<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSPedidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPedidosPresenter
 *
 * @package namespace LSAPI\Presenters;
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
