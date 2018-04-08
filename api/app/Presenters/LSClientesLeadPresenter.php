<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSClientesLeadTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSClientesLeadPresenter
 *
 * @package namespace LSAPI\Presenters;
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
