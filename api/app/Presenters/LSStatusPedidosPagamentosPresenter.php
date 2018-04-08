<?php

namespace api\Presenters;

use api\Transformers\LSStatusPedidosPagamentosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSStatusPedidosPagamentosPresenter
 *
 * @package namespace api\Presenters;
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
