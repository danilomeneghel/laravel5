<?php

namespace api\Repositories;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;
use api\Presenters\LSPedidosPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use api\Entities\LSPedidos;
use api\Entities\LSClientes;
use api\Entities\LSProdutos;

/**
 * Class LSPedidosRepositoryEloquent
 * @package namespace api\Repositories;
 */
class LSPedidosRepositoryEloquent extends BaseRepository implements LSPedidosRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() {
        return LSPedidos::class;
        return LSClientes::class;
        return LSProdutos::class;
    }

    public function presenter() {
        return LSPedidosPresenter::class;
        return LSClientesPresenter::class;
        return LSProdutosPresenter::class;
    }
    
    public function searchAdvanced($search_field, $tipo_busca)
    {
        $result = $this->with(['status_pedido_pagamento' => function($query){
            $query->with('status')->orderBy('created_at','desc');
        }, 'pagamentos' => function($query) {
            $query->with('metodo_pagamento');
        }, 'produtos' => function($query) use ($search_field, $tipo_busca) {
            if($tipo_busca == "nome_produto") {
                $query->whereHas('produto', function ($query) use ($search_field, $tipo_busca) {
                    $query->where('ls_produtos.nome', 'like', "%$search_field%")->groupBy('ls_produtos.id');
                });
            }
        }, 'descontos'])->scopeQuery(function($query) use ($search_field, $tipo_busca) {
            if($tipo_busca == "codigo_origem_pedido_hash" or empty($tipo_busca)){
                $query->where('codigo_origem_pedido_hash', '=', "$search_field");
            }
            if($tipo_busca == "cpf_cnpj") {
                $query->whereHas('clientes', function ($query) use ($search_field) {
                    $query->where('ls_clientes.cpf_cnpj', '=', "$search_field");
                });
            }
            return $query->orderBy('id');
        });
        
        return $result;
    }
    
    public function searchPedidoCliente($cliente_id, $status_id, $fonte_id)
    {
        $result = $this->with(['produtos'])->scopeQuery(function($query) use ($status_id, $cliente_id) {
            $query->whereHas('status_pedido_pagamento', function ($query) use ($status_id) {
                $query->where('ls_status_pedidos_pagamentos.ls_status_id', '=', $status_id);
            });            
            $query->whereHas('clientes', function ($query) use ($cliente_id) {
                $query->where('ls_clientes.id', '=', $cliente_id);
            });
            return $query->orderBy('id');
        })->findWhere(['ls_fontes_id' => $fonte_id]);
        
        return $result;
    }
    
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }
}
