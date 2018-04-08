<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSDescontosPedidos;

/**
 * Class LSDescontosPedidosTransformer
 * @package namespace api\Transformers;
 */
class LSDescontosPedidosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSDescontosPedidos entity
     * @param \LSDescontosPedidos $model
     *
     * @return array
     */
    public function transform(LSDescontosPedidos $model) {
        return [
            'id'         => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}