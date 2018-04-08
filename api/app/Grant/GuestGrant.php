<?php

namespace LSAPI\Grant;

use \League\OAuth2\Server\Entity\AccessTokenEntity;
use \League\OAuth2\Server\Entity\ClientEntity;
use \League\OAuth2\Server\Entity\SessionEntity;
use \League\OAuth2\Server\Event;
use \League\OAuth2\Server\Exception;
use League\OAuth2\Server\Grant\AbstractGrant;
use \League\OAuth2\Server\Util\SecureKey;
use LSAPI\Entities\LSClientes;

/**
 * Password grant class
 */
class GuestGrant extends AbstractGrant
{
    /**
     * Grant identifier
     * @var string
     */
    protected $identifier = 'guest';

    /**
     * Response type
     * @var string
     */
    protected $responseType;

    /**
     * Callback to authenticate a user's name and password
     * @var callable
     */
    protected $callback;

    /**
     * Access token expires in override
     * @var int
     */
    protected $accessTokenTTL;

    /**
     * Return the callback function
     * @return callable
     * @throws
     * @note not used this time.
     */

    /**
     * Complete the password grant
     * @return array
     * @throws
     */
    public function completeFlow()
    {
        $username   = null;
        $password   = null;
        #userID moved to line 78, maybe temporary fix.
        $ifNative   = 0;

        /** Aqui consultamos o Model LS_Clientes */
        $ls_email = $this->server->getRequest()->request->get('email', null);
        if (is_null($ls_email)) {
            throw new Exception\InvalidRequestException('email');
        }

        $ls_cliente = LSClientes::where(['email' => $ls_email])
            ->select('id')
            ->first();

        if (is_null($ls_cliente)) {
            throw new Exception\UnauthorizedClientException();
        }

        $ls_cliente->toArray();
        
        $userId = $ls_cliente['id'];

        // Get the required params
        $clientId = $this->server->getRequest()->request->get('client_id', null);
        if (is_null($clientId)) {
            $clientId = $this->server->getRequest()->getUser();
            if (is_null($clientId)) {
                throw new Exception\InvalidRequestException('client_id');
            }
        }

        $clientSecret = $this->server->getRequest()->request->get('client_secret', null);
        if (is_null($clientSecret)) {
            $clientSecret = $this->server->getRequest()->getPassword();
            if (is_null($clientSecret)) {
                throw new Exception\InvalidRequestException('client_secret');
            }
        }

        // Validate client ID and client secret
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

        // Validate any scopes that are in the request
        $scopeParam = $this->server->getRequest()->request->get('scope', '');
        $scopes = $this->validateScopes($scopeParam, $client);

        // Create a new session
        $session = new SessionEntity($this->server);
        
        $session->setOwner('user', $userId);
        $session->associateClient($client);

        // Generate an access token
        $SecureKey = SecureKey::generate();
        $accessToken = new AccessTokenEntity($this->server);
        $accessToken->setId($SecureKey);
        $accessToken->setExpireTime($this->getAccessTokenTTL() + time() + $ifNative);

        // Associate scopes with the session and access token
        foreach ($scopes as $scope) {
            $session->associateScope($scope);
        }

        foreach ($session->getScopes() as $scope) {
            $accessToken->associateScope($scope);
        }
        $this->server->getTokenType()->setSession($session);
        $this->server->getTokenType()->setParam('access_token', $accessToken->getId());
        $this->server->getTokenType()->setParam('expires_in', $this->getAccessTokenTTL() + $ifNative);
        $this->server->getTokenType()->setParam('ls_clientes_id', $ls_cliente['id']);

        // Save everything
        $session->save();
        $accessToken->setSession($session);
        $accessToken->save();

        return [
            'access_token'  => $this->server->getTokenType()->getParam('access_token'),
            'token_type'    => 'Bearer',
            'expires_in'    => $this->server->getTokenType()->getParam('expires_in'),
            'id'            => $this->server->getTokenType()->getParam('ls_clientes_id')
        ];
    }
}