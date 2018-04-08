<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSStatusPedidosPagamentos;

/**
 * Class LSStatusPedidosPagamentosTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSStatusPedidosPagamentosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSStatusPedidosPagamentos entity
     * @param \LSStatusPedidosPagamentos $statusPedidoPagamento
     *
     * @return array
     */
    public function transform(LSStatusPedidosPagamentos $statusPedidoPagamento) {
        return [
            'id'                => (int)$statusPedidoPagamento->id,
            'ls_pagamentos_id'  => $statusPedidoPagamento->ls_pagamentos_id,
            'ls_pedidos_id'     => $statusPedidoPagamento->ls_pedidos_id,
            'ls_status_id'      => $statusPedidoPagamento->ls_status_id,
            'descricao'         => $statusPedidoPagamento->descricao,
            'created_at'        => $statusPedidoPagamento->created_at,
            'updated_at'        => $statusPedidoPagamento->updated_at
        ];
    }
}