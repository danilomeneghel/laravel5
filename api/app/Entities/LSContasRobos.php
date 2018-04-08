<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSContasRobos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ls_contas_robos';

    protected $fillable = [
        'ls_produtos_id',
        'ls_pedidos_id',
        'ls_contas_meta_trader_id',
        'ativos',
        'inicio_uso',
        'limite',
        'status',
        'created_at',
        'updated_at',
        'disabled_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany(LSPedidos::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produtos()
    {
        return $this->hasMany(LSProdutosPedidos::class, 'ls_pedidos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagamentos()
    {
        return $this->hasMany(LSPagamentos::class, 'ls_pedidos_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function status_pedido_pagamento()
    {
        return $this->hasMany(LSStatusPedidosPagamentos::class, 'ls_pedidos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conta_meta_trader()
    {
        return $this->belongsTo(LSContasMetaTrader::class, 'ls_contas_meta_trader_id');
    }
}
