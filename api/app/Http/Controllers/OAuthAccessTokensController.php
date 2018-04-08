<?php

namespace LSAPI\Http\Controllers;

use Illuminate\Http\Request;
use LSAPI\Http\Requests;
use LSAPI\Http\Controllers\Controller;
use LSAPI\Repositories\OAuthAccessTokensRepository;
use LSAPI\Services\OAuthAccessTokensService;

class OAuthAccessTokensController extends Controller {

    /**
     * @var OAuthAccessTokensRepository
     */
    private $repository;

    /**
     * OAuthAccessTokensController constructor.
     * @param OAuthAccessTokensRepository $repository
     * @param OAuthAccessTokensService $service
     */
    public function __construct(OAuthAccessTokensRepository $repository) {
        $this->repository = $repository;
    }

    public function show($id) {
        return $this->repository->skipPresenter()->find($id);
    }

    public function modifyExpireTime(Request $request, $id) {
        return $this->repository->skipPresenter()->update($request->all(), $id);
    }

    public function verificaExpiracaoToken($token) {
        $oauth = $this->show($token);

        if (date('Y-m-d H:i:s') <= date('Y-m-d H:i:s', $oauth['expire_time'])) {
            echo true;
        } else {
            echo false;
        }
    }

}
