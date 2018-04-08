<?php

namespace api\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LSClientesLead extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'ls_clientes_lead';

    protected $fillable = [
        'ls_clientes_id',
        'ls_parceiros_id',
        'nome',
        'sexo',
        'data_nascimento',
        'cpf_cnpj',
        'email',
        'telefone'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parceiros()
    {
        return $this->hasMany(LSParceiros::class, 'ls_parceiros_id');
    }

    /* MUTATORS */
    public function setCpfCnpjAttribute($value)
    {
        $this->attributes['cpf_cnpj'] = preg_replace('/\D/', '', $value);
    }

    public function setDataNascimentoAttribute($value)
    {
        $this->attributes['data_nascimento'] = Carbon::createFromFormat("d/m/Y", $value);
    }

}
