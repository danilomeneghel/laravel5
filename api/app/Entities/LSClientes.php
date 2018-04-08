<?php

namespace LSAPI\Entities;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class LSClientes extends Model implements Transformable, AuthenticatableContract, CanResetPasswordContract
{
    use TransformableTrait, Authenticatable, CanResetPassword;

    protected $table = "ls_clientes";

    protected $fillable = [
        "nome",
        "sexo",
        "data_nascimento",
        "cpf_cnpj",
        "ls_fontes_id",
        "email",
        "password",
        "codigo_origem_cliente",
        "codigo_origem_cliente_xp",
        "codigo_origem_cliente_antigo",
        "net",
        "corretagem",
        "lslive",
        "username",
        "created_at",
        "updated_at"
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany(LSPedidos::class, 'ls_clientes_id');
    }

    public function emails()
    {
        return $this->hasMany(LSEmails::class, 'ls_clientes_id')->whereNull('ls_emails.disabled_at')->orderBy('id','asc');
    }

    public function telefones()
    {
        /*$userType = App::make('UserType');
        if(!empty($userType) && $userType == 'admin')
            return $this->hasMany(LSTelefones::class, 'ls_clientes_id')->whereNull('ls_telefones.disabled_at')->orderBy('id','asc');
        else*/
            return $this->hasMany(LSTelefones::class, 'ls_clientes_id')->whereNull('ls_telefones.disabled_at')->where('ls_fontes_id','!=',3)->orderBy('ls_fontes_id','asc')->orderBy('id','desc');
    }

    public function enderecos()
    {
        /*$userType = App::make('UserType');
        if(!empty($userType) && $userType == 'admin')
            return $this->hasMany(LSEnderecos::class, 'ls_clientes_id')->whereNull('ls_pedidos_id')->orderBy('id','asc');
        else*/
            return $this->hasMany(LSEnderecos::class, 'ls_clientes_id')->whereNull('ls_pedidos_id')->where('ls_fontes_id','!=',3)->orderBy('ls_fontes_id','asc')->limit(1);
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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = (isset($value) && !empty($value) ? bcrypt($value) : null);
    }
}
