<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSPedidosCategoriasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPedidosCategoriasPresenter
 *
 * @package namespace LSAPI\Presenters;
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
