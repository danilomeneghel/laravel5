<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSProdutosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSProdutosPresenter
 *
 * @package namespace LSAPI\Presenters;
 */
class LSProdutosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSProdutosTransformer();
    }
}
