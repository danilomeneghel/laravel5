<?php

namespace api\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSClientesLeadValidator extends LaravelValidator 
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|min:3|max:255',
            'sexo' => 'required|min:1',
            'data_nascimento' => 'required|min:8',
            'cpf_cnpj' => 'required|unique:ls_clientes,cpf_cnpj|regex:/^\d{11}$/',
            'email' => 'required|max:255|unique:ls_clientes,email|regex:/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',
            'telefone' => 'required|regex:/^[0-9]{9,12}$/',
            'ls_clientes_id' => 'required',
            'ls_parceiros_id' => 'sometimes'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|min:3|max:255',
            'sexo' => 'required|min:1',
            'data_nascimento' => 'required|min:8',
            'email' => 'sometimes|max:255|regex:/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',
            'telefone' => 'required|regex:/^[0-9]{9,12}$/'
        ]
    ];

}
