<?php

namespace api\Validators;

use Prettus\Validator\LaravelValidator;

class LSLeadsValidator extends LaravelValidator
{
    protected $rules = [
        'nome' => 'sometimes|required|min:3|max:255',
        'cpf' => 'sometimes|required',
        'email' => 'sometimes|required|email|email_leads_exists|max:255'
    ];

}