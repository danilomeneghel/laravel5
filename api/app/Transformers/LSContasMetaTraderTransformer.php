<?php

namespace LSAPI\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use LSAPI\Entities\LSContasMetaTrader;

/**
 * Class LSContasMetaTraderTransformer
 * @package namespace LSAPI\Transformers;
 */
class LSContasMetaTraderTransformer extends TransformerAbstract 
{

    /**
     * Transform the \LSContasMetaTrader entity
     * @param \LSContasMetaTrader $model
     *
     * @return array
     */
    public function transform(LSContasMetaTrader $model) 
    {
        return [
            'id'                        => (int) $model->id,
            'ls_clientes_id'            => $model->ls_clientes_id,
            'nome'                      => $model->nome,
            'conta_real'                => $model->conta_real,
            'created_at'                => ( !empty($model->created_at) ?  Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d/m/Y H:i') : '-'),
            'conta_robo'                => $model->conta_robo
        ];
    }

}
