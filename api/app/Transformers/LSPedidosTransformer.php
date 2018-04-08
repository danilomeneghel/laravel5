<?php

namespace LSAPI\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSPedidos;

/**
 * Class LSPedidosTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSPedidosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSPedidos entity
     * @param \LSPedidos $pedidos
     * @return array
     */
    public function transform(LSPedidos $pedidos) {
        return [
            'id'                        => (int)$pedidos->id,
            'ls_clientes_id'            => $pedidos->ls_clientes_id,
            'ls_fontes_id'              => $pedidos->ls_fontes_id,
            'ls_pedidos_categorias_id'  => $pedidos->ls_pedidos_categorias_id,
            'codigo_origem_pedido'      => $pedidos->codigo_origem_pedido,
            'codigo_origem_pedido_hash' => $pedidos->codigo_origem_pedido_hash,
            'vencimento'                => $pedidos->vencimento,
            'descricao'                 => $pedidos->descricao,
            'total'                     => $pedidos->total,
            'sub_total'                 => $pedidos->sub_total,
            'created_at'                => ( !empty($pedidos->created_at) ?  Carbon::createFromFormat('Y-m-d H:i:s', $pedidos->created_at)->format('d/m/Y H:i') : '-'),
            'clientes'                  => $pedidos->clientes,
            'categoria'                 => $pedidos->categoria,
            'produtos'                  => $pedidos->produtos,
            'descontos'                 => $pedidos->descontos,
            'enderecos'                 => $pedidos->enderecos,
            'status_pedido_pagamento'   => $pedidos->status_pedido_pagamento,
        ];
    }
}