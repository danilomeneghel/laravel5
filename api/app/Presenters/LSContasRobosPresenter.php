<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSContasRobosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPedidosPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSContasRobosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSContasRobosTransformer();
    }
}
