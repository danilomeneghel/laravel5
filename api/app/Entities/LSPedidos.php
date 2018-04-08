<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSPedidos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "ls_pedidos";

    protected $fillable = [
        'ls_clientes_id',
        'ls_fontes_id',
        'ls_pedidos_categorias_id',
        'codigo_origem_pedido',
        'codigo_origem_pedido_hash',
        'vencimento',
        'descricao',
        'total',
        'sub_total',
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientes()
    {
        return $this->belongsTo(LSClientes::class, 'ls_clientes_id');
    }

    public function categoria()
    {
        return $this->belongsTo(LSPedidosCategorias::class, 'ls_pedidos_categorias_id');
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
    public function produtos()
    {
        return $this->hasMany(LSProdutosPedidos::class, 'ls_pedidos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function status_pedido_pagamento()
    {
        return $this->hasMany(LSStatusPedidosPagamentos::class, 'ls_pedidos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descontos()
    {
        return $this->hasMany(LSDescontosPedidos::class, 'ls_pedidos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enderecos()
    {
        return $this->hasMany(LSEnderecos::class, 'ls_clientes_id');
    }
}
