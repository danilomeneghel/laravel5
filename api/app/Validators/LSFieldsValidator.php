<?php

namespace api\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSFieldsValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|min:3|max:255',
            'password' => 'required|regex:/^[\d\w]+/|min:6',
            'cpf_cnpj' => 'required|regex:/^\d{11}$/|unique:ls_clientes,cpf_cnpj',
            'email' => 'required|email|max:255|unique:ls_clientes,email',
            'telefone' => 'required|regex:/^[0-9]{9,12}$/'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|min:3|max:255',
            'password' => 'required|regex:/^[\d\w]+/|min:6',
            'cpf_cnpj' => 'required|regex:/^\d{11}$/',
            'email' => 'required|email|max:255',
            'telefone' => 'required|regex:/^[0-9]{9,12}$/'
        ]
    ];

}
