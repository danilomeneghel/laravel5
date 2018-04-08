<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSClientesTransformer;
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