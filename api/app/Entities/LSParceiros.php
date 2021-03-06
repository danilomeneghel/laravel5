<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSParceiros extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ls_parceiros';

    protected $fillable = [
        'nome'
    ];


}
