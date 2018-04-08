<?php

namespace LSAPI\Providers;

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
            \LSAPI\Repositories\LSClientesRepository::class, 
            \LSAPI\Repositories\LSClientesRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\UserRepository::class,
            \LSAPI\Repositories\UserRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSEmailsRepository::class,
            \LSAPI\Repositories\LSEmailsRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSTelefonesRepository::class,
            \LSAPI\Repositories\LSTelefonesRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSEnderecosRepository::class,
            \LSAPI\Repositories\LSEnderecosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSCategoriasProdutosRepository::class,
            \LSAPI\Repositories\LSCategoriasProdutosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSDescontosPedidosRepository::class,
            \LSAPI\Repositories\LSDescontosPedidosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSMetodosPagamentosRepository::class,
            \LSAPI\Repositories\LSMetodosPagamentosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSPagamentosRepository::class,
            \LSAPI\Repositories\LSPagamentosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSPedidosCategoriasRepository::class,
            \LSAPI\Repositories\LSPedidosCategoriasRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSProdutosPedidosRepository::class,
            \LSAPI\Repositories\LSProdutosPedidosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSProdutosRepository::class,
            \LSAPI\Repositories\LSProdutosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSStatusPedidosPagamentosRepository::class,
            \LSAPI\Repositories\LSStatusPedidosPagamentosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSStatusRepository::class,
            \LSAPI\Repositories\LSStatusRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSSubProdutosPedidosRepository::class,
            \LSAPI\Repositories\LSSubProdutosPedidosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSClientesLeadRepository::class,
            \LSAPI\Repositories\LSClientesLeadRepositoryEloquent::class
        );
        
        $this->app->bind(
            \LSAPI\Repositories\LSParceirosRepository::class,
            \LSAPI\Repositories\LSParceirosRepositoryEloquent::class
        );

        $this->app->bind(
            \LSAPI\Repositories\LSPedidosRepository::class,
            \LSAPI\Repositories\LSPedidosRepositoryEloquent::class
        );
        
        $this->app->bind(
            \LSAPI\Repositories\LSLeadsRepository::class,
            \LSAPI\Repositories\LSLeadsRepositoryEloquent::class
        );
        
        $this->app->bind(
            \LSAPI\Repositories\CRMRepository::class,
            \LSAPI\Repositories\CRMRepositoryEloquent::class
        );
        
        $this->app->bind(
            \LSAPI\Repositories\OAuthAccessTokensRepository::class,
            \LSAPI\Repositories\OAuthAccessTokensRepositoryEloquent::class
        );
        
        $this->app->bind(
            \LSAPI\Repositories\LSContasMetaTraderRepository::class,
            \LSAPI\Repositories\LSContasMetaTraderRepositoryEloquent::class
        );
        
        $this->app->bind(
            \LSAPI\Repositories\LSContasRobosRepository::class,
            \LSAPI\Repositories\LSContasRobosRepositoryEloquent::class
        );
    }
}
