<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSClientes;
use api\Entities\User;

/**
 * Class UserTransformer
 * @package namespace api\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        "lscliente"
    ];
    /**
     * Transform the \User entity
     * @param \User $user
     *
     * @return array
     */
    public function transform(User $user) {
        return [
            'id'                    => (int)$user->id,
            'name'                  => $user->name,
            'single_email'          => $user->email,
            'created_at_format'     => $user->created_at->format('d/m/Y H:i'),
            'updated_at_format'     => $user->updated_at->format('d/m/Y H:i'),
            'created_at'            => $user->created_at,
            'updated_at'            => $user->updated_at,
            'type'                  => $user->type,
            'setor'                 => $user->setor,
            'pipedrive_id'          => $user->pipedrive_id
        ];
    }

    public function includeLSCliente(User $user)
    {
        if ( $user->ls_cliente instanceof LSClientes ) {
            return $this->item($user->ls_cliente, new LSClientesTransformer());
        }
    }
}