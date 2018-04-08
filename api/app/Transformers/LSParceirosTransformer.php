<?php

namespace api\Transformers;

use api\Entities\LSParceiros;
use League\Fractal\TransformerAbstract;

class LSParceirosTransformer extends TransformerAbstract {

    public function transform(LSParceiros $parceiros) {
        return [
            'id' => $parceiros->id,
            'nome' => (!empty($parceiros->nome) ? $parceiros->nome : '-'),
        ];
    }

}
