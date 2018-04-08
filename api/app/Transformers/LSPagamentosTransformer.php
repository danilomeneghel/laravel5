<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSPagamentos;

/**
 * Class LSPagamentosTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSPagamentosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSPagamentos entity
     * @param \LSPagamentos $model
     *
     * @return array
     */
    public function transform(LSPagamentos $model) {
        return [
            'id'                        => (int)$model->id,
            'ls_pedidos_id'             => $model->ls_pedidos_id,
            'ls_fontes_id'              => $model->ls_fontes_id,
            'ls_metodos_pagamentos_id'  => $model->ls_metodos_pagamentos_id,
            'transaction_hash'          => $model->transaction_hash,
            'qtde_parcelas'             => $model->qtde_parcelas,
            'created_at'                => $model->created_at,
            'updated_at'                => $model->updated_at
        ];
    }
}