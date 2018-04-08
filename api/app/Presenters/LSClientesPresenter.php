<?php

namespace api\Presenters;

use api\Transformers\LSClientesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class LSClientesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSClientesTransformer();
    }
}