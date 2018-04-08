<?php

namespace api\Providers;

use Illuminate\Support\ServiceProvider;

class LSRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \api\Repositories\LSClientesRepository::class, 
            \api\Repositories\LSClientesRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\UserRepository::class,
            \api\Repositories\UserRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSEmailsRepository::class,
            \api\Repositories\LSEmailsRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSTelefonesRepository::class,
            \api\Repositories\LSTelefonesRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSEnderecosRepository::class,
            \api\Repositories\LSEnderecosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSCategoriasProdutosRepository::class,
            \api\Repositories\LSCategoriasProdutosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSDescontosPedidosRepository::class,
            \api\Repositories\LSDescontosPedidosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSMetodosPagamentosRepository::class,
            \api\Repositories\LSMetodosPagamentosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSPagamentosRepository::class,
            \api\Repositories\LSPagamentosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSPedidosCategoriasRepository::class,
            \api\Repositories\LSPedidosCategoriasRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSProdutosPedidosRepository::class,
            \api\Repositories\LSProdutosPedidosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSProdutosRepository::class,
            \api\Repositories\LSProdutosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSStatusPedidosPagamentosRepository::class,
            \api\Repositories\LSStatusPedidosPagamentosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSStatusRepository::class,
            \api\Repositories\LSStatusRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSSubProdutosPedidosRepository::class,
            \api\Repositories\LSSubProdutosPedidosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSClientesLeadRepository::class,
            \api\Repositories\LSClientesLeadRepositoryEloquent::class
        );
        
        $this->app->bind(
            \api\Repositories\LSParceirosRepository::class,
            \api\Repositories\LSParceirosRepositoryEloquent::class
        );

        $this->app->bind(
            \api\Repositories\LSPedidosRepository::class,
            \api\Repositories\LSPedidosRepositoryEloquent::class
        );
        
        $this->app->bind(
            \api\Repositories\LSLeadsRepository::class,
            \api\Repositories\LSLeadsRepositoryEloquent::class
        );
        
        $this->app->bind(
            \api\Repositories\CRMRepository::class,
            \api\Repositories\CRMRepositoryEloquent::class
        );
        
        $this->app->bind(
            \api\Repositories\OAuthAccessTokensRepository::class,
            \api\Repositories\OAuthAccessTokensRepositoryEloquent::class
        );
        
        $this->app->bind(
            \api\Repositories\LSContasMetaTraderRepository::class,
            \api\Repositories\LSContasMetaTraderRepositoryEloquent::class
        );
        
        $this->app->bind(
            \api\Repositories\LSContasRobosRepository::class,
            \api\Repositories\LSContasRobosRepositoryEloquent::class
        );
    }
}
