<?php

namespace api\Presenters;

use api\Transformers\LSTelefonesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSTelefonesPresenter
 *
 * @package namespace api\Presenters;
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
