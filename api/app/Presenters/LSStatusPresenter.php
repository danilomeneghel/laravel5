<?php

namespace api\Presenters;

use api\Transformers\LSStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSStatusPresenter
 *
 * @package namespace api\Presenters;
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
