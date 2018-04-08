<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSTelefones extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ls_telefones';

    protected $fillable = [
        'telefone',
        'ls_clientes_id',
        'ls_fontes_id',
        'disabled_at',
        'created_at',
        'updated_at'
    ];

}
