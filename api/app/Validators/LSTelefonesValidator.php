<?php

namespace api\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSTelefonesValidator extends LaravelValidator 
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'telefone' => 'required|regex:/^[0-9]{9,12}$/',
            'ls_clientes_id' => 'required',
            'ls_fontes_id' => 'sometimes'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'telefone' => 'sometimes|regex:/^[0-9]{9,12}$/'
        ]
    ];
}
