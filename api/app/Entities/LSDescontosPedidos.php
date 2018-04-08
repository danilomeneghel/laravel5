<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSDescontosPedidos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'ls_descontos_pedidos';

    protected $fillable = [
        'desconto',
        'nome',
        'tipo',
        'proporcao',
        'ls_pedidos_id',
        'created_at',
        'updated_at'
    ];

}
