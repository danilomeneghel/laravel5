<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSSubProdutosPedidos;

/**
 * Class LSSubProdutosPedidosTransformer
 * @package namespace api\Transformers;
 */
class LSSubProdutosPedidosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSSubProdutosPedidos entity
     * @param \LSSubProdutosPedidos $model
     *
     * @return array
     */
    public function transform(LSSubProdutosPedidos $model) {
        return [
            'id'         => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}