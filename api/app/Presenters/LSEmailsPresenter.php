<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSEmailsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSEmailsPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSEmailsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSEmailsTransformer();
    }
}
