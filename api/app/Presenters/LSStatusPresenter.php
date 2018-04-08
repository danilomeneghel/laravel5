<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSStatusPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSStatusTransformer();
    }
}
