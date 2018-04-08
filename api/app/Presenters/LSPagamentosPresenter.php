<?php

namespace api\Presenters;

use api\Transformers\LSPagamentosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPagamentosPresenter
 *
 * @package namespace api\Presenters;
 */
class LSPagamentosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSPagamentosTransformer();
    }
}
