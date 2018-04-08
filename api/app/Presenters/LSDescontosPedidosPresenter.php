<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSDescontosPedidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSDescontosPedidosPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSDescontosPedidosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSDescontosPedidosTransformer();
    }
}
