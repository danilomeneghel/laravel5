<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSProdutosPedidos;

/**
 * Class LSProdutosPedidosTransformer
 * @package namespace api\Transformers;
 */
class LSProdutosPedidosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSProdutosPedidos entity
     * @param \LSProdutosPedidos $model
     *
     * @return array
     */
    public function transform(LSProdutosPedidos $model) {
        return [
            'id'             => (int)$model->id,
            'ls_produtos_id' => $model->ls_produtos_id,
            'ls_pedidos_id'  => $model->ls_pedidos_id,
            'created_at'     => $model->created_at,
            'updated_at'     => $model->updated_at
        ];
    }
}