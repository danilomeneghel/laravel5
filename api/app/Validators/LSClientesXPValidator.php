<?php

namespace LSAPI\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSClientesXPValidator extends LaravelValidator 
{
    protected $rules = [
        'nome' => 'required|min:3|max:255',
        'password' => 'required|regex:/^[\d\w]+/|min:6',
        'cpf_cnpj' => 'required|regex:/^\d{11}$/',
        'email' => 'required|email|max:255'
    ];

}
