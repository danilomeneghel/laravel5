<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSTelefonesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSTelefonesPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSTelefonesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSTelefonesTransformer();
    }
}
