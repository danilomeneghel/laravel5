<?php

namespace LSAPI\Validators;

use Prettus\Validator\LaravelValidator;

class LSEnderecosValidator extends LaravelValidator
{
    protected $rules = [
        'ls_clientes_id' => 'required',
        'ls_fontes_id' => 'sometimes'
    ];
}