<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSDescontosPedidos;

/**
 * Class LSDescontosPedidosTransformer
 * @package namespace LSAPI\Transformers;
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