<?php

namespace api\Presenters;

use api\Transformers\LSProdutosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSProdutosPresenter
 *
 * @package namespace api\Presenters;
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
