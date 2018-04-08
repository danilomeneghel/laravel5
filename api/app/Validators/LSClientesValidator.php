<?php

namespace api\Validators;

use Prettus\Validator\LaravelValidator;

class LSClientesValidator extends LaravelValidator
{
    protected $rules = [
        'nome' => 'sometimes|required|min:3|max:255',
        'password' => 'sometimes|required|regex:/^[\d\w]+/|min:6',
        'cpf_cnpj' => 'sometimes|exists:ls_clientes,cpf_cnpj',
        'email' => 'sometimes|required|email|max:255|unique:ls_clientes,email'
    ];

}