<?php

namespace LSAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSContasMetaTrader extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ls_contas_meta_trader';

    protected $fillable = [
        'ls_clientes_id',
        'nome',
        'conta_real',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientes()
    {
        return $this->hasMany(LSClientes::class, 'ls_clientes_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conta_robo()
    {
        return $this->hasMany(LSContasRobos::class, 'ls_contas_meta_trader_id');
    }

}
