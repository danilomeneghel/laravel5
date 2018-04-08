<?php

namespace api\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use api\Entities\LSClientesLead;

/**
 * Class LSClientesLeadTransformer
 * @package namespace api\Transformers;
 */
class LSClientesLeadTransformer extends TransformerAbstract {

    /**
     * Transform the \LSClientesLead entity
     * @param \LSClientesLead $model
     *
     * @return array
     */
    public function transform(LSClientesLead $model) {
        return [
            'id' => (int) $model->id,
            'nome' => (!empty($model->nome) ? $model->nome : '-'),
            'sexo' => (!empty($model->sexo) ? $model->sexo : '-'),
            'data_nascimento' => (!empty($model->data_nascimento) ? Carbon::createFromFormat('Y-m-d', $model->data_nascimento)->format('d/m/Y') : '-'),
            'cpf_cnpj' => (!empty($model->cpf_cnpj) ? $model->cpf_cnpj : '-'),
            'email' => (!empty($model->email) ? $model->email : '-'),
            'telefone' => (!empty($model->telefone) ? $model->telefone : '-'),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

}
