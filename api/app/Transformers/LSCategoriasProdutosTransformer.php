<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSCategoriasProdutos;

/**
 * Class LSCategoriasProdutosTransformer
 * @package namespace api\Transformers;
 */
class LSCategoriasProdutosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSCategoriasProdutos entity
     * @param \LSCategoriasProdutos $model
     *
     * @return array
     */
    public function transform(LSCategoriasProdutos $model) {
        return [
            'id'         => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}