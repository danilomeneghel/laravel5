<?php

namespace LSAPI\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSClientesSiteValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|min:3|max:255',
            'password' => 'required|regex:/^[\d\w]+/|min:6',
            'cpf_cnpj' => 'required|unique:ls_clientes,cpf_cnpj|regex:/^\d{11}$/',
            'email' => 'required|unique:ls_clientes,email|regex:/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',
            'data_nascimento' => 'required|min:8',
            'sexo' => 'required|min:1',
            'ls_fontes_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'sometimes|min:3|max:255',
            'password' => 'sometimes|regex:/^[\d\w]+/|min:6',
            'cpf_cnpj' => 'sometimes|regex:/^\d{11}$/',
            'email' => 'sometimes|max:255',
            'data_nascimento' => 'sometimes|min:8',
            'sexo' => 'sometimes|min:1',
            'ls_fontes_id' => 'required'
        ]
    ];
}