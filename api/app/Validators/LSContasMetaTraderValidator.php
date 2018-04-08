<?php

namespace LSAPI\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSContasMetaTraderValidator extends LaravelValidator 
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'ls_clientes_id' => 'required',
            'ls_produtos_id' => 'required',
            'nome' => 'required|min:3|max:255',
            'conta_real' => 'required|min:3'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|min:3|max:255',
            'conta_real' => 'required|min:3'
        ]
    ];

}
