<?php

namespace api\Presenters;

use api\Transformers\LSDescontosPedidosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSDescontosPedidosPresenter
 *
 * @package namespace api\Presenters;
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
