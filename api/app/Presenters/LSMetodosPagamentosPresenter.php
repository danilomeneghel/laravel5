<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSMetodosPagamentosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSMetodosPagamentosPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSMetodosPagamentosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSMetodosPagamentosTransformer();
    }
}
