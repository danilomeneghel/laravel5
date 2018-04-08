<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSContasMetaTraderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPedidosPresenter
 *
 * @package namespace LSAPI\Presenters;
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
