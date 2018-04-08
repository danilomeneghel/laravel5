<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSStatus;

/**
 * Class LSStatusTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSStatusTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSStatus entity
     * @param \LSStatus $model
     *
     * @return array
     */
    public function transform(LSStatus $model) {
        return [
            'id'         => (int)$model->id,
            'nome'       => $model->nome,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}