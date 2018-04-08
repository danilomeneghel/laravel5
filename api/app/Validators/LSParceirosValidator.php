<?php

namespace LSAPI\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSParceirosValidator extends LaravelValidator 
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|min:3|max:255'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|min:3|max:255'
        ]
    ];

}
