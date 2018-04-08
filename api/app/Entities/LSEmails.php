<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSEmails extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ls_emails';

    protected $fillable = [
        'email',
        'ls_fontes_id',
        'ls_clientes_id',
        'created_at',
        'updated_at',
        'disabled_at'
    ];

}
