<?php

namespace painel\Http\Controllers;

use painel\Http\Requests;

class UserController extends Controller {

    private $tipos;
    private $setores;
    
    public function __construct() {
        $this->tipos = ['admin' => 'Administrador', 'user' => 'Usuário'];
        $this->setores = [1 => 'Comercial', 2 => 'Capacitação'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('pages.users.form', ["url" => api_url("usuarios"), "tipos" => $this->tipos, "setores" => $this->setores]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        
        return view('pages.users.form', ["id" => $id, "url" => api_url("usuarios/{$id}"), "tipos" => $this->tipos, "setores" => $this->setores]);
    }

}
