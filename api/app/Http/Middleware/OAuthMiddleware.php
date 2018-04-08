<?php

namespace api\Http\Middleware;

use Closure;
use League\OAuth2\Server\Exception\AccessDeniedException;
use League\OAuth2\Server\Exception\InvalidScopeException;
use LucaDegasperi\OAuth2Server\Authorizer;
use Illuminate\Support\Facades\Auth;
use api\Repositories\UserRepository;
use api\Entities\User;

/**
 * This is the oauth middleware class.
 *
 * @author Luca Degasperi <packages@lucadegasperi.com>
 */
class OAuthMiddleware {

    /**
     * The Authorizer instance.
     *
     * @var \LucaDegasperi\OAuth2Server\Authorizer
     */
    protected $authorizer;

    /**
     * Whether or not to check the http headers only for an access token.
     *
     * @var bool
     */
    protected $httpHeadersOnly = false;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * Create a new oauth middleware instance.
     *
     * @param \LucaDegasperi\OAuth2Server\Authorizer $authorizer
     * @param bool $httpHeadersOnly
     */
    public function __construct(Authorizer $authorizer, $httpHeadersOnly = false, UserRepository $repository) {
        $this->authorizer = $authorizer;
        $this->httpHeadersOnly = $httpHeadersOnly;
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $scopesString
     *
     * @throws \League\OAuth2\Server\Exception\InvalidScopeException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $scopesString = null) {
        //Pega as roles da rota acessada
        $roles = $this->getRequiredRoleForRoute($request->route());

        $scopes = [];
        if (!is_null($scopesString)) {
            $scopes = explode('+', $scopesString);
        }

        try {
            $this->authorizer->setRequest($request);
            $this->authorizer->validateAccessToken($this->httpHeadersOnly);
            $this->validateScopes($scopes);

            foreach ($scopes as $scope) {
                if (array_keys($this->authorizer->getScopes())[0] == $scope) {
                    if (is_array($roles)) {
                        foreach ($roles as $role) {
                            $roleResult = $this->authorizer->getResourceOwnerType();

                            if ($role == $roleResult)
                                return $next($request);
                        }
                    } else {
                        $roleResult = $this->authorizer->getResourceOwnerType();

                        if ($roles == $roleResult)
                            return $next($request);
                    }
                }
            }
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'error_type' => '',
                    'message' => 'Sem permissão de acesso!',
                ],
            ];
            return response()->json($json, 400);
        } catch (AccessDeniedException $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'error_type' => $e->errorType,
                    'message' => trans("auth.{$e->errorType}"),
                ],
            ];

            if (isset($e->httpStatusCode) && !empty($e->httpStatusCode)) {
                return response()->json($json, $e->httpStatusCode);
            }

            return response()->json($json, 500);
        }
    }

    /**
     * Validate the scopes.
     *
     * @param $scopes
     *
     * @throws \League\OAuth2\Server\Exception\InvalidScopeException
     */
    public function validateScopes($scopes) {
        if (is_array($scopes)) {
            foreach ($scopes as $s) {
                if ($this->authorizer->hasScope($s) === false) {
                    return false;
                }
            }
            return true;
        }
        return $this->getAccessToken()->hasScope($scope);
    }

    private function getRequiredRoleForRoute($route) {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }

}
