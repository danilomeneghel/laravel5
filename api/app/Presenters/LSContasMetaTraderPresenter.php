<?php

namespace api\Presenters;

use api\Transformers\LSContasMetaTraderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPedidosPresenter
 *
 * @package namespace api\Presenters;
 */
class LSContasMetaTraderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSContasMetaTraderTransformer();
    }
}
