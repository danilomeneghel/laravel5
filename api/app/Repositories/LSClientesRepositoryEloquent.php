<?php

namespace api\Repositories;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;
use Prettus\Repository\Eloquent\BaseRepository;
use api\Entities\LSClientes;
use api\Entities\LSTelefones;
use api\Presenters\LSClientesPresenter;

/**
 * Class LSClientesRepositoryEloquent
 * @package namespace api\Repositories;
 */
class LSClientesRepositoryEloquent extends BaseRepository implements LSClientesRepository {

    public function model() {
        return LSClientes::class;
        return LSTelefones::class;
    }

    public function presenter() {
        return LSClientesPresenter::class;
    }

    public function search($search_field) {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSClientes::where(function ($query2) use ($search_field) {
                    $query2->where('nome', 'ilike', "%$search_field%");
                    $query2->orWhere('cpf_cnpj', 'ilike', "%$search_field%");
                    $query2->orWhere('email', 'ilike', "%$search_field%");
                })
                ->paginate(24);
        return $this->parserResult($result);
    }

    public function searchCpfCnpj($search_field) {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSClientes::where('cpf_cnpj', '=', $search_field)
                ->paginate(24);
        return $this->parserResult($result);
    }

    public function emailPrimarioOutroUsuario($id, $data) {
        $result = LSClientes::where(function ($query) use ($id, $data) {
                            $query->where('id', '!=', $id);
                            $query->where('email', '=', $data['email']);
                        })
                        ->paginate(24)->isEmpty();
        return $result;
    }

    public function pedidos($id) {
        $aPedidos = [];
        $result = $this->skipPresenter()->with(['pedidos' => function($query) {
                $query->with(['pagamentos' => function($query0) {
                        $query0->with('metodo_pagamento');
                    }, 'produtos']);
            }])->find($id);

        if (isset($result['pedidos']) && !empty($result['pedidos'])) {
            foreach ($result['pedidos'] as $key => $pedido) {
                $aPedido = [
                    'id' => $pedido->id,
                    'data_hora' => $pedido->created_at->format('d/m/Y H:i'),
                    'total' => mon($pedido->total)
                ];
                $aPagamento = [];
                if (isset($pedido->pagamentos) && !empty($pedido->pagamentos)) {
                    foreach ($pedido->pagamentos as $key => $pagamento) {
                        array_push($aPagamento, $pagamento->metodo_pagamento->nome);
                    }
                }
                $sPagamento = implode(',', $aPagamento);
                $aPedido = array_add($aPedido, 'metodo_pagamento', $sPagamento);

                $iQuantidade = 0;
                if (isset($pedido->produtos) && !empty($pedido->produtos)) {
                    foreach ($pedido->produtos as $key => $produto) {
                        $iQuantidade += $produto->quantidade;
                    }
                }
                $aPedido = array_add($aPedido, 'quantidade', $iQuantidade);

                array_push($aPedidos, $aPedido);
            }
        }
        return $aPedidos;
    }

    public function get_lslive($id) {
        $lslive = LSClientes::where(function ($query) use ($id) {
                    $query->where('id', '=', $id);
                })
                ->where(function ($query) {
                    $query->where('corretagem', '>', 100);
                    $query->orWhere('net', '>', 9900);
                    $query->orWhere('lslive', '>', date('Y-m-d 00:00:00'));
                })
                ->get()
                ->isEmpty();

        return $lslive;
    }

}
