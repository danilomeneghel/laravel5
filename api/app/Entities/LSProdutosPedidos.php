<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSProdutosPedidos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'ls_produtos_pedidos';

    protected $fillable = [
        'ls_produtos_id',
        'ls_pedidos_id',
        'preco',
        'quantidade',
        'created_at',
        'updated_at'
    ];

    public function pedido()
    {
        return $this->belongsTo(LSPedidos::class, 'ls_pedidos_id');
    }
    
    public function produto()
    {
        return $this->belongsTo(LSProdutos::class, 'ls_produtos_id');
    }
}
