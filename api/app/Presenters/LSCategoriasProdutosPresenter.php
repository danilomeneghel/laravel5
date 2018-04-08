<?php

namespace LSAPI\Presenters;

use LSAPI\Transformers\LSCategoriasProdutosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LSCategoriasProdutosPresenter
 *
 * @package namespace LSAPI\Presenters;
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
