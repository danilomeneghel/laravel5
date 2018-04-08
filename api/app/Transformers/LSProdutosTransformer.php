<?php

namespace api\Transformers;

use League\Fractal\TransformerAbstract;
use api\Entities\LSProdutos;

/**
 * Class LSProdutosTransformer
 * @package namespace api\Transformers;
 */
class LSProdutosTransformer extends TransformerAbstract
{

    /**
     * Transform the \LSProdutos entity
     * @param \LSProdutos $model
     *
     * @return array
     */
    public function transform(LSProdutos $model) {
        return [
            'id'                    => (int)$model->id,
            'codigo_origem_produto' => $model->codigo_origem_produto,
            'nome'                  => $model->nome,
            'preco'                 => $model->preco,
            'imagem'                => $model->imagem,
            'descricao'             => $model->descricao,
            'slug'                  => $model->slug,
            'created_at'            => $model->created_at,
            'updated_at'            => $model->updated_at
        ];
    }
}