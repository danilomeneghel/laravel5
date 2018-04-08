<?php

namespace api\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSPedidosValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            //'ls_clientes_id' => 'required',
            'ls_fontes_id' => 'sometimes',
            'descricao' => 'sometimes'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'descricao' => 'sometimes'
        ]
    ];

}
