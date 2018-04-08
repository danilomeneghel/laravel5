<?php

namespace api\Http\Controllers;

use Illuminate\Http\Request;
use api\Http\Requests;
use api\Http\Controllers\Controller;
use api\Repositories\OAuthAccessTokensRepository;
use api\Services\OAuthAccessTokensService;

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
