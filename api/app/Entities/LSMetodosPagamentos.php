<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSMetodosPagamentos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'ls_metodos_pagamentos';

    protected $fillable = [
        'nome',
        'created_at',
        'updated_at'
    ];

}
