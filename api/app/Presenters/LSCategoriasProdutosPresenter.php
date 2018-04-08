<?php

namespace api\Presenters;

use api\Transformers\LSCategoriasProdutosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSCategoriasProdutosPresenter
 *
 * @package namespace api\Presenters;
 */
class LSCategoriasProdutosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LSCategoriasProdutosTransformer();
    }
}
