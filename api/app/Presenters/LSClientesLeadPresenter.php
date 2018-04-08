<?php

namespace api\Presenters;

use api\Transformers\LSClientesLeadTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSClientesLeadPresenter
 *
 * @package namespace api\Presenters;
 */
class LSClientesLeadPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSClientesLeadTransformer();
    }
}
