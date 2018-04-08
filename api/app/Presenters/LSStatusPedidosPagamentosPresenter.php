<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSStatusPedidosPagamentosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSStatusPedidosPagamentosPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSStatusPedidosPagamentosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSStatusPedidosPagamentosTransformer();
    }
}
