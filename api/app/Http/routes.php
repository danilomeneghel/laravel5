<?php

#temporary Use of Illuminate\Http\Request;

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/** NAO ESQUECER DE INSTALAR O PACOTE pt_BR.utf8 NO S.O. */
Route::before(function ($request) {
    setlocale(LC_TIME, 'pt_BR.utf8');
});

/** Autenticação */
Route::post('/oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

/** Recupera os dados através do token */
Route::get('get_access_token/{id}', 'OAuthAccessTokensController@show');

/** Atualiza a data de expiração do token */
Route::put('modify_expire_time/{id}', 'OAuthAccessTokensController@modifyExpireTime');

/** Verifica a expiração do token */
Route::get('expiracao_token/{token}', 'OAuthAccessTokensController@verificaExpiracaoToken');

/** Rota para fazer os testes, é temporária e será apagada */
Route::post('generate/password', function(Request $request) {
    return bcrypt($request->input('password'));
});

/** Pega os produtos da fonte requisitada */
Route::get('produtos/fonte/{id}', 'LSProdutosController@searchFont');

/** Pega os produtos do slug requisitado */
Route::get('produtos/slug/{slug}', 'LSProdutosController@searchSlug');

/** Cria novo cliente */
Route::post('clientes/site', 'LSClientesController@store');

/** Cria novo email */
Route::post('emails', 'LSEmailsController@store');

/** Cria novo telefone */
Route::post('telefones', 'LSTelefonesController@store');

/** Cria novo endereço */
Route::post('enderecos/create', 'LSEnderecosController@store');

/** Consulta o cliente por qualquer campo */
Route::get('clientes/search/{search_field}', 'LSClientesController@search');

/** Consulta o cliente somente pelo CPF/CNPJ */
Route::get('clientes/search_cpf_cnpj/{search_field}', 'LSClientesController@searchCpfCnpj');

/** Atualiza a data do LSLive */
Route::put('clientes/atualizar_lslive/{id}', 'LSClientesController@update_lslive');

/** Recuperar a senha do usuário */
Route::put('clientes/esqueci_senha/{id}', 'LSClientesController@update_senha');

/** Cria novo cliente no CRM Pipedrive */
Route::post('create_person_crm', 'CRMController@create_person_crm');

/** Cria novo negócio no CRM Pipedrive */
Route::post('create_deal_crm', 'CRMController@create_deal_crm');

/** Cria nova atividade no CRM Pipedrive */
Route::post('create_activity_crm', 'CRMController@create_activity_crm');

/** Cria uma nova Lead para o cliente */
Route::post('clientes/lead', 'LSClientesLeadController@store');

/** Cria um novo parceiro */
Route::post('parceiros', 'LSParceirosController@store');

/** Cria uma nova conta do metatrader */
Route::post('contas_metatrader', 'LSContasMetaTraderController@store');

/** Cria uma nova conta do robo */
Route::post('contas_robos', 'LSContasRobosController@store');

/** Valida se o cliente pode usar o robo no MT5 */
Route::get('usar_robo/{data}', 'LSContasMetaTraderController@useRobot');

/** Lista os dados do cliente pelo seu ID */
Route::get('clientes/{id}', 'LSClientesController@show');

/*
 * @Tudo abaixo passa por autenticação do oauth
 */
/** Acesso ao escopo LSSite e LSPainel para admin, client e user */
Route::group(['middleware' => 'oauth:LSPainel+LSEducacao+LSQuant+LSAnalise', 'roles' => ['admin', 'client', 'user']], function () {
    /** Clientes */
    Route::get('clientes_logado', 'LSClientesController@logged');
    Route::get('clientes/{id}/pedidos', 'LSClientesController@pedidos');
    Route::get('clientes', 'LSClientesController@index');

    /** Emails */
    Route::get('emails', 'LSEmailsController@index');
    Route::get('emails/search/{search_field}', 'LSEmailsController@search');
    Route::get('emails/{id}', 'LSEmailsController@show');
    
    /** Telefones */
    Route::get('telefones', 'LSTelefonesController@index');
    Route::get('telefones/search/{search_field}', 'LSTelefonesController@search');
    Route::get('telefones/{id}', 'LSTelefonesController@show');
    
    /** Endereços */
    Route::get('enderecos', 'LSEnderecosController@index');
    Route::get('enderecos/search/{search_field}', 'LSEnderecosController@search');
    Route::get('enderecos/{id}', 'LSEnderecosController@show');
    
    /** Pedidos */
    Route::get('pedidos/search/{search_field}', 'LSPedidosController@search');
    
    /** Cria e lista os pedidos */
    Route::resource('pedidos', 'LSPedidosController', ['except' => ['edit']]);
    
    /** Pesquisa avançada de pedidos */
    Route::get('pedidos/searchAdvanced/{search_field}/{tipo_busca}', 'LSPedidosController@searchAdvanced');
    
    /** Lista os pedidos do cliente logado */
    Route::get('pedidos/searchPedidoCliente/{cliente_id}/{status_id}/{fonte_id}', 'LSPedidosController@searchPedidoCliente');

    /** LS Produtos pedidos */
    Route::get('produtos_pedidos/search/{search_field}', 'LSProdutosPedidosController@search');
    Route::resource('produtos_pedidos', 'LSProdutosPedidosController', ['except' => ['create', 'edit']]);

    /** LS Descontos pedidos */
    Route::get('descontos_pedidos/search/{search_field}', 'LSDescontosPedidosController@search');
    Route::resource('descontos_pedidos', 'LSDescontosPedidosController', ['except' => ['create', 'edit']]);

    /** LS Sub produtos pedidos */
    Route::get('sub_produtos_pedidos/search/{search_field}', 'LSSubProdutosPedidosController@search');
    Route::resource('sub_produtos_pedidos', 'LSSubProdutosPedidosController', ['except' => ['create', 'edit']]);

    /* LS Pagamentos */
    Route::get('pagamentos/search/{search_field}', 'LSPagamentosController@search');
    Route::resource('pagamentos', 'LSPagamentosController', ['except' => ['create', 'edit']]);

    /* LS Métodos pagamentos */
    Route::get('metodos_pagamentos/search/{search_field}', 'LSMetodosPagamentosController@search');
    Route::resource('metodos_pagamentos', 'LSMetodosPagamentosController', ['except' => ['create', 'edit']]);

    /* LS Produtos */
    Route::get('produtos/search/{search_field}', 'LSProdutosController@search');

    /* LS Categorias produtos */
    Route::get('categorias_produtos/search/{search_field}', 'LSCategoriasProdutosController@search');
    Route::resource('categorias_produtos', 'LSCategoriasProdutosController', ['except' => ['create', 'edit']]);

    /* LS Status */
    Route::get('status/search/{search_field}', 'LSStatusController@search');
    Route::resource('status', 'LSStatusController', ['except' => ['create', 'edit']]);

    /* LS Status pedidos pagamentos */
    Route::get('status_pedidos_pagamentos/search/{search_field}', 'LSStatusPedidosPagamentosController@search');
    Route::resource('status_pedidos_pagamentos', 'LSStatusPedidosPagamentosController', ['except' => ['create', 'edit']]);
    
    /* LS Pedidos categorias */
    Route::get('pedidos_categorias/search/{search_field}', 'LSPedidosCategoriasController@search');
    Route::resource('pedidos_categorias', 'LSPedidosCategoriasController', ['except' => ['create', 'edit']]);
    
    /* LS Contas MetaTrader */
    Route::get('contas_metatrader', 'LSContasMetaTraderController@index');
    Route::get('contas_metatrader/search/{search_field}', 'LSContasMetaTraderController@search');
    Route::get('contas_metatrader/{id}', 'LSContasMetaTraderController@show');
    
    /* LS Contas Robos */
    Route::get('contas_robos', 'LSContasRobosController@index');
    Route::get('contas_robos/search/{search_field}', 'LSContasRobosController@search');
    Route::get('contas_robos/{id}', 'LSContasRobosController@show');    
});

/** Acesso ao escopo LSSite e LSPainel para admin e client */
Route::group(['middleware' => 'oauth:LSPainel+LSEducacao+LSQuant+LSAnalise', 'roles' => ['admin', 'client']], function () {
    /** Clientes */
    Route::put('clientes/site/{id}', 'LSClientesController@update');
    
    /** Emails */
    Route::put('emails/{id}', 'LSEmailsController@update');
    
    /** Telefones */
    Route::put('telefones/{id}', 'LSTelefonesController@update');
    
    /** Endereços */
    Route::put('enderecos/{id}', 'LSEnderecosController@update');
});

/** Acesso somente ao escopo LSPainel e admin */
Route::group(['middleware' => 'oauth:LSPainel', 'roles' => 'admin'], function () {
    /** Usuários */
    Route::get('usuarios/search/{search_field}', 'UserController@search');
    Route::get('usuarios/{id}', 'UserController@show');
    Route::resource('usuarios', 'UserController', ['except' => ['create', 'edit']]);

    /** Produtos */
    Route::get('produtos', 'LSProdutosController@index');
    Route::post('produtos', 'LSProdutosController@store');
    Route::put('produtos/{id}', 'LSProdutosController@update');
    Route::delete('produtos/{id}', 'LSProdutosController@destroy');

    /** Categoria produtos */
    Route::post('categorias_produtos', 'LSCategoriasProdutosController@store');
    Route::put('categorias_produtos', 'LSCategoriasProdutosController@update');
});
