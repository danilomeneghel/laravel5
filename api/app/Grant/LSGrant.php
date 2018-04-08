<?php

namespace LSAPI\Grant;

use \League\OAuth2\Server\Entity\AccessTokenEntity;
use \League\OAuth2\Server\Entity\ClientEntity;
use \League\OAuth2\Server\Entity\SessionEntity;
use \League\OAuth2\Server\Event;
use \League\OAuth2\Server\Exception;
use \League\OAuth2\Server\Grant\AbstractGrant;
use \League\OAuth2\Server\Util\SecureKey;
use LSAPI\Entities\LSClientes;
use LSAPI\Entities\User;

/**
 * Password grant class
 */
class LSGrant extends AbstractGrant
{
    /**
     * Grant identifier
     *
     * @var string
     */
    protected $identifier = 'password';

    /**
     * Response type
     *
     * @var string
     */
    protected $responseType;

    /**
     * Callback to authenticate a user's name and password
     *
     * @var callable
     */
    protected $callback;

    /**
     * Access token expires in override
     *
     * @var int
     */
    protected $accessTokenTTL;

    /**
     * Set the callback to verify a user's username and password
     *
     * @param callable $callback The callback function
     *
     * @return void
     */
    public function setVerifyCredentialsCallback(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Return the callback function
     *
     * @return callable
     *
     * @throws
     */
    protected function getVerifyCredentialsCallback()
    {
        if (is_null($this->callback) || !is_callable($this->callback)) {
            throw new Exception\ServerErrorException('Null or non-callable callback set on Password grant');
        }

        return $this->callback;
    }

    /**
     * Complete the password grant
     * @return array
     * @throws
     */
    public function completeFlow()
    {
        // Pega o email
        $emailParam = $this->server->getRequest()->request->get('username');
        if (is_null($emailParam)) {
            throw new Exception\InvalidRequestException('username');
        }
        // Pega a senha
        $passwordParam = $this->server->getRequest()->request->get('password', null);
        if (is_null($passwordParam)) {
            throw new Exception\InvalidRequestException('password');
        }
        // Verifica se o usuário e a senha estão corretos
        $userCredentials = call_user_func($this->getVerifyCredentialsCallback(), $emailParam, $passwordParam);
        if ($userCredentials === false) {
            $this->server->getEventEmitter()->emit(new Event\UserAuthenticationFailedEvent($this->server->getRequest()));
            throw new Exception\InvalidCredentialsException();
        }

        // Pega o scope
        $scopeParam = $this->server->getRequest()->request->get('scope');
        if (is_null($scopeParam)) {
            throw new Exception\InvalidRequestException('scope');
        }
        
        if($scopeParam == 'LSEducacao' || $scopeParam == 'LSImob' || $scopeParam == 'LSCapital' || $scopeParam == 'LSAnalise' || $scopeParam == 'LSGlobal' || $scopeParam == 'LSQuant' || $scopeParam == 'LSGrupo') {
            //Consulta a tabela ls_clientes
            $user = LSClientes::where(['email' => $emailParam])
                ->select('id', 'nome')
                ->first();

            if (is_null($user)) {
                throw new Exception\UnauthorizedClientException();
            }

            $user->toArray();            
            $user_id = $user['id'];
            $user_name = $user['nome'];
            $user_type = 'client';
        } else if($scopeParam == 'LSPainel') {
            //Consulta a tabela users
            $user = User::where(['email' => $emailParam])
                ->select(['id', 'name', 'type'])
                ->first();

            if (is_null($user)) {
                throw new Exception\UnauthorizedClientException();
            }

            $user->toArray();            
            $user_id = $user['id'];
            $user_name = $user['name'];
            $user_type = $user['type'];
        } else {
            throw new Exception\UnauthorizedClientException();
        }

        // Pega o client ID
        $clientId = $this->server->getRequest()->request->get('client_id', null);
        if (is_null($clientId)) {
            $clientId = $this->server->getRequest()->getUser();
            if (is_null($clientId)) {
                throw new Exception\InvalidRequestException('client_id');
            }
        }
        // Pega o client secret
        $clientSecret = $this->server->getRequest()->request->get('client_secret', null);
        if (is_null($clientSecret)) {
            $clientSecret = $this->server->getRequest()->getPassword();
            if (is_null($clientSecret)) {
                throw new Exception\InvalidRequestException('client_secret');
            }
        }
        
        // Valida o client ID e client secret
        $client = $this->server->getClientStorage()->get(
            $clientId,
            $clientSecret,
            null,
            $this->getIdentifier()
        );

        if (($client instanceof ClientEntity) === false) {
            $this->server->getEventEmitter()->emit(new Event\ClientAuthenticationFailedEvent($this->server->getRequest()));
            throw new Exception\InvalidClientException();
        }

        // Valida os escopos enviado
        $scopes = $this->validateScopes($scopeParam, $client);

        // Cria uma nova sessão com os principais dados
        $session = new SessionEntity($this->server);
        $session->setOwner($user_type, $user_id);
        $session->associateClient($client);
        
        // Gera um access token
        $accessToken = new AccessTokenEntity($this->server);
        $accessToken->setId(SecureKey::generate());
        $accessToken->setExpireTime($this->getAccessTokenTTL() + time());

        // Associa os escopos com a session e access token
        foreach ($scopes as $scope) {
            $session->associateScope($scope);
        }

        foreach ($session->getScopes() as $scope) {
            $accessToken->associateScope($scope);
        }

        // Cria os parametros que irão para sessão
        $this->server->getTokenType()->setSession($session);
        $this->server->getTokenType()->setParam('access_token', $accessToken->getId());
        $this->server->getTokenType()->setParam('expires_in', $this->getAccessTokenTTL());
        $this->server->getTokenType()->setParam('scope', $scopeParam);
        $this->server->getTokenType()->setParam('user_name', $user_name);
        $this->server->getTokenType()->setParam('user_type', $user_type);

        // Salva todos os parametros na sessão
        $session->save();
        $accessToken->setSession($session);
        $accessToken->save();

        return [
            'access_token'  => $this->server->getTokenType()->getParam('access_token'),
            'token_type'    => 'Bearer',
            'expires_in'    => $this->server->getTokenType()->getParam('expires_in'),
            'scope'         => $this->server->getTokenType()->getParam('scope'),
            'user_name'     => $this->server->getTokenType()->getParam('user_name'),
            'user_type'     => $this->server->getTokenType()->getParam('user_type')
        ];
    }
}