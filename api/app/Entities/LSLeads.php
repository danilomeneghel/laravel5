<?php

namespace LSAPI\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSLeads extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ls_leads';

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'email',
        'telefone',
        'celular'
    ];

}
