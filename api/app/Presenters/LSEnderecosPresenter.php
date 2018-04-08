<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSEnderecosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSEnderecosPresenter
 *
 * @package namespace LSAPI\Presenters;
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
