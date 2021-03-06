<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSPedidosCategorias;

/**
 * Class LSPedidosCategoriasTransformer
 * @package namespace api\Transformers;
 */
class LSPedidosCategoriasTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSPedidosCategorias entity
     * @param \LSPedidosCategorias $model
     *
     * @return array
     */
    public function transform(LSPedidosCategorias $model) {
        return [
            'id'         => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}