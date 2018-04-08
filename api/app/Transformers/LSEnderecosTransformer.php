<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSEnderecos;

/**
 * Class LSEnderecosTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSEnderecosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSEnderecos entity
     * @param \LSEnderecos $model
     *
     * @return array
     */
    public function transform(LSEnderecos $model) {
        return [
            'id'         => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}