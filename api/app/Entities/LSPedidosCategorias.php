<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSPedidosCategorias extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = "ls_pedidos_categorias";

    protected $fillable = [
        "nome",
        "created_at",
        "updated_at"
    ];

}
