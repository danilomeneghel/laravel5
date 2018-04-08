<?php

namespace api\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LSProdutosValidator extends LaravelValidator 
{
	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
	        'ls_fontes_id' => 'required',
	        'nome' => 'required',
	        'preco' => 'required',
	        'imagem' => 'sometimes',
	        'descricao' => 'required',
	        'link'	=>	'sometimes',
	        'versao' => 'sometimes'
	    ],
	    ValidatorInterface::RULE_UPDATE => [
	    	'nome' => 'required',
	        'preco' => 'required',
	        'imagem' => 'sometimes',
	        'descricao' => 'required',
	        'link'	=>	'sometimes',
	        'versao' => 'sometimes'
	    ]
    ];
}