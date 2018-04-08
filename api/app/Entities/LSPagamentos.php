<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSPagamentos extends Model implements Transformable
{
    use TransformableTrait;

    protected $table    = 'ls_pagamentos';

    protected $fillable = [
        'id',
        'ls_pedidos_id',
        'ls_fontes_id',
        'ls_metodos_pagamentos_id',
        'transaction_hash',
        'qtde_parcelas',
        'created_at',
        'updated_at'
    ];

    public function pedido()
    {
        return $this->belongsTo(LSPedidos::class, 'ls_pedidos_id');
    }

    public function metodo_pagamento()
    {
        return $this->belongsTo(LSMetodosPagamentos::class, 'ls_metodos_pagamentos_id');
    }
}
