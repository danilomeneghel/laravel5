<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSTelefones;

/**
 * Class LSTelefonesTransformer
 * @package namespace api\Transformers;
 */
class LSTelefonesTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSTelefones entity
     * @param \LSTelefones $model
     *
     * @return array
     */
    public function transform(LSTelefones $model) {
        return [
            'id'         => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}