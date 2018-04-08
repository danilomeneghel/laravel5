<?php

namespace LSAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSStatusPedidosPagamentos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'ls_status_pedidos_pagamentos';

    protected $fillable = [
        'ls_pagamentos_id',
        'ls_pedidos_id',
        'ls_status_id',
        'descricao',
        'created_at',
        'updated_at',
    ];

    public function status()
    {
        return $this->belongsTo(LSStatus::class, 'ls_status_id');
    }
}
