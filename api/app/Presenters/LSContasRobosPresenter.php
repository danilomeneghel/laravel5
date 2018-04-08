<?php

namespace api\Presenters;

use api\Transformers\LSContasRobosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPedidosPresenter
 *
 * @package namespace api\Presenters;
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
