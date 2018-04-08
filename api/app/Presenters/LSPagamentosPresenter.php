<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSPagamentosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSPagamentosPresenter
 *
 * @package namespace LSAPI\Presenters;
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
