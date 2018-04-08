<?php

namespace LSAPI\OAuth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use LSAPI\Repositories\LSClientesRepository;
use LSAPI\Services\LSClientesService;
use LSAPI\Services\UserService;
use LSAPI\Entities\User;
use LSAPI\Entities\LSClientes;
use MikeMcLin\WpPassword\Facades\WpPassword;
use Hash;

class Verifier {

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var LSClientesRepository
     */
    private $repository;

    /**
     * @var LSClientesService
     */
    private $clientesService;

    /**
     * Verifier constructor.
     */
    public function __construct(UserService $userService, LSClientesService $clientesService, LSClientesRepository $repository) {
        $this->userService = $userService;
        $this->repository = $repository;
        $this->clientesService = $clientesService;
    }

    public function verify($username, $password) {
        $credentials = [
            'email' => $username,
            'password' => $password
        ];

        /** Acesso interno na API (painel) */
        if (Input::get('scope') == 'LSPainel') {
            config(['auth.model' => User::class]);

            if (Auth::once($credentials)) {
                return Auth::user()->id;
            }

            return false;
            /** Acesso externo na API (site) */
        } else {
            config(['auth.model' => LSClientes::class]);

            // Localiza usuário no banco para comparar senhas
            $ls_cliente = DB::table('ls_clientes')
                    ->where('email', '=', $username)
                    ->get();

            if (!empty($ls_cliente)) {
                // Condiçoes de login para cliente
                $id = $ls_cliente[0]->id;
                $hashed_password = $ls_cliente[0]->password;
                if (Auth::once($credentials)) {
                    return Auth::user()->id;
                }
                if ($this->isHashSiteAntigo($password, $hashed_password, $id) === true) {
                    return $id;
                }
                if ($this->isHashWP($password, $hashed_password, $id) === true) {
                    return $id;
                }
            }

            return false;
        }
    }

    private function isHashLaravel($password, $hashed_password) {
        if (Hash::check($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }

    private function isHashWP($password, $hashed_password, $id) {
        $data = array();
        if (WpPassword::check($password, $hashed_password)) {
            //Atualiza a senha para o padrão do Laravel
            $data['password'] = $password;
            $this->repository->update($data, $id);
            return true;
        } else {
            return false;
        }
    }

    private function isHashSiteAntigo($password, $hashed_password, $id) {
        $data = array();
        $pass = md5($password);
        if ($pass == $hashed_password) {
            //Atualiza a senha para o padrão do Laravel
            $data['password'] = $password;
            $this->repository->update($data, $id);
            return true;
        } else {
            return false;
        }
    }

}
