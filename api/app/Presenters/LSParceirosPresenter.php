<?php

namespace api\Presenters;

use api\Transformers\LSParceirosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSParceirosPresenter
 *
 * @package namespace api\Presenters;
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
