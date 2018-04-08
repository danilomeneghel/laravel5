<?php

namespace LSAPI\Transformers;

use Carbon\Carbon;
use LSAPI\Entities\LSContasRobos;
use League\Fractal\TransformerAbstract;

/**
 * Class LSContasRobosTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSContasRobosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSContasRobos entity
     * @param \LSContasRobos $model
     *
     * @return array
     */
    public function transform(LSContasRobos $model) {
        return [
            'id'                        => (int)$model->id,
            'ls_produtos_id'            => $model->ls_produtos_id,
            'ls_pedidos_id'             => $model->ls_pedidos_id,
            'ls_contas_meta_trader_id'  => $model->ls_contas_meta_trader_id,
            'ativos'                    => $model->ativos,
            'inicio_uso'                => $model->inicio_uso,
            'limite'                    => $model->limite,
            'status'                    => $model->status,
            'created_at'                => ( !empty($model->created_at) ?  Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d/m/Y H:i') : '-'),
            'pedidos'                   => $model->pedidos,
            'produtos'                  => $model->produtos,
            'pagamentos'                => $model->pagamentos,
            'status_pedido_pagamento'   => $model->status_pedido_pagamento,
            'conta_meta_trader'         => $model->conta_meta_trader
        ];
    }
}