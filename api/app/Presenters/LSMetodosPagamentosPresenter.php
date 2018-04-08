<?php

namespace api\Presenters;

use api\Transformers\LSMetodosPagamentosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSMetodosPagamentosPresenter
 *
 * @package namespace api\Presenters;
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
