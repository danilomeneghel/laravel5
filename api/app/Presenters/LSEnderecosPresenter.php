<?php

namespace api\Presenters;

use api\Transformers\LSEnderecosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSEnderecosPresenter
 *
 * @package namespace api\Presenters;
 */
class LSEnderecosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSEnderecosTransformer();
    }
}
