<?php

namespace LSAPI\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSSenhaValidator extends LaravelValidator
{
    protected $rules = [
        'password' => 'sometimes|required|regex:/^[\d\w]+/|min:6'
    ];

}