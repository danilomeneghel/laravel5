<?php

namespace api\Presenters;

use api\Transformers\LSPedidosCategoriasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPedidosCategoriasPresenter
 *
 * @package namespace api\Presenters;
 */
class LSPedidosCategoriasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSPedidosCategoriasTransformer();
    }
}
