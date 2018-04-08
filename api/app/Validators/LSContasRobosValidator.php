<?php

namespace api\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSContasRobosValidator extends LaravelValidator 
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'ls_produtos_id' => 'required',
            'ls_contas_meta_trader_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
        ]
    ];

}
