<?php

namespace LSAPI\Transformers;

use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSEmails;

/**
 * Class LSEmailsTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSEmailsTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSEmails entity
     * @param \LSEmails $model
     *
     * @return array
     */
    public function transform(LSEmails $model) {
        return [
            'id'         => (int)$model->id,
            
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}