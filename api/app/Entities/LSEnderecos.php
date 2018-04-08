<?php

namespace LSAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSEnderecos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ls_enderecos';

    protected $fillable = [
        'ls_fontes_id',
        'ls_clientes_id',
        'cep',
        'logradouro',
        'complemento',
        'cidade',
        'uf',
        'numero',
        'pais',
        'bairro',
        'descricao',
        'created_at',
        'updated_at'
    ];

}
