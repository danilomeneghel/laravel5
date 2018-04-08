<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSParceirosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSParceirosPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSParceirosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSParceirosTransformer();
    }
}
