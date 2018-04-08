<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSLeads;

/**
 * Class LSLeadsTransformer
 * @package namespace LSAPI\Transformers;
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