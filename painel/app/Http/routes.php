<?php

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

Route::get('/', function () {
    return view('layouts.login');
});
Route::resource('dashboard', 'DashboardController', ['only' => ['index', 'create', 'show', 'edit']]);
Route::resource('clientes', 'CustomerController', ['only' => ['index', 'create', 'show', 'edit']]);
Route::resource('usuarios', 'UserController', ['only' => ['index', 'create', 'show', 'edit']]);
Route::resource('pedidos', 'RequestController', ['only' => ['index', 'create', 'show', 'edit']]);
Route::resource('produtos', 'ProductController', ['only' => ['index', 'create', 'show', 'edit']]);
Route::post('oauth', 'OAuthController@store');
