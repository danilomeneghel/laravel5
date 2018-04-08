<?php

namespace LSAPI\Transformers;

use Carbon\Carbon;
use LSAPI\Entities\LSClientes;
use League\Fractal\TransformerAbstract;

class LSClientesTransformer extends TransformerAbstract {

    public function transform(LSClientes $clientes) {
        return [
            'id' => $clientes->id,
            'nome' => (!empty($clientes->nome) ? $clientes->nome : '-'),
            'email' => (!empty($clientes->email) ? $clientes->email : '-'),
            'sexo' => (!empty($clientes->sexo) ? $clientes->sexo : '-'),
            'cpf_cnpj' => (!empty($clientes->cpf_cnpj) ? $clientes->cpf_cnpj: '-'),
            'data_nascimento' => (!empty($clientes->data_nascimento) ? Carbon::createFromFormat('Y-m-d', $clientes->data_nascimento)->format('d/m/Y') : '-'),
            'net' => (!empty($clientes->net) ? $clientes->net : '0.00'),
            'corretagem' => (!empty($clientes->corretagem) ? $clientes->corretagem : '0.00'),
            'codigo_origem_cliente' => (!empty($clientes->codigo_origem_cliente) ? $clientes->codigo_origem_cliente : '-'),
            'codigo_origem_cliente_xp' => (!empty($clientes->codigo_origem_cliente_xp) ? $clientes->codigo_origem_cliente_xp : '-'),
            'codigo_origem_cliente_antigo' => (!empty($clientes->codigo_origem_cliente_antigo) ? $clientes->codigo_origem_cliente_antigo : '-'),
            'lslive' => (!empty($clientes->lslive) ? Carbon::createFromFormat('Y-m-d H:i:s', $clientes->lslive)->format('d/m/Y') : '-'),
            'username' => (!empty($clientes->username) ? $clientes->username : '-'),
            'emails' => $clientes->emails,
            'enderecos' => $clientes->enderecos,
            'telefones' => $clientes->telefones,
            'pedidos' => $clientes->pedidos
        ];
    }

    public function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '0') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

}
