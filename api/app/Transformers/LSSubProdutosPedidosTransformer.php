<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSSubProdutosPedidos;

/**
 * Class LSSubProdutosPedidosTransformer
 * @package namespace LSAPI\Transformers;
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