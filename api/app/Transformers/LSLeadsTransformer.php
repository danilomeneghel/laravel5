<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSLeads;

/**
 * Class LSLeadsTransformer
 * @package namespace api\Transformers;
 */
class LSLeadsTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSLeads entity
     * @param \LSLeads $model
     *
     * @return array
     */
    public function transform(LSLeads $model) {
        return [
            'id'                     => (int)$model->id,
            'nome'                   => $model->nome,
            'cpf'                    => $model->cpf,
            'data_nascimento'        => $model->data_nascimento,
            'email'                  => $model->email,
            'telefone'               => $model->telefone,
            'celular'                => $model->celular
        ];
    }
}