<?php

namespace LSAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSProdutos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'ls_produtos';

    protected $fillable = [
        'id',
        'ls_fontes_id',
        'codigo_origem_produto',
        'link',
        'versao',
        'nome',
        'preco',
        'imagem',
        'descricao',
        'slug',
        'created_at',
        'updated_at',
        'disabled_at'
    ];

}
