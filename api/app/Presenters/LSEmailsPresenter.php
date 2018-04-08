<?php

namespace api\Presenters;

use api\Transformers\LSEmailsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSEmailsPresenter
 *
 * @package namespace api\Presenters;
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
