<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSMetodosPagamentos;

/**
 * Class LSMetodosPagamentosTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSMetodosPagamentosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSMetodosPagamentos entity
     * @param \LSMetodosPagamentos $model
     *
     * @return array
     */
    public function transform(LSMetodosPagamentos $model) {
        return [
            'id'         => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}