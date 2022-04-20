<?php

namespace Omnipay\CobreFacil;

use Omnipay\CobreFacil\Message\AuthenticateRequest;
use Omnipay\CobreFacil\Message\AuthenticateResponse;
use Omnipay\CobreFacil\Message\FetchCustomerRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;

/**
 * Cobre Fácil Gateway
 *
 * @link https://developers.cobrefacil.com.br
 */
class Gateway extends AbstractGateway
{
    /**
     * @var bool
     */
    private $production = true;

    /**
     * @var string|null
     */
    private $authorizationToken;

    /**
     * @inheritdoc
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        if (!empty($parameters)) {
            /** @var AuthenticateResponse $authenticateResponse */
            $authenticateResponse = $this->authenticate($parameters)->send();
            $this->authorizationToken = $authenticateResponse->getToken();
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Cobre Fácil';
    }

    /**
     * @return bool
     */
    public function getProduction(): bool
    {
        return $this->production;
    }

    /**
     * @param bool $production
     * @return Gateway
     */
    public function setProduction(bool $production): Gateway
    {
        $this->production = $production;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationToken(): string
    {
        return $this->authorizationToken;
    }

    /**
     * @param string $authorizationToken
     * @return Gateway
     */
    public function setAuthorizationToken(string $authorizationToken): Gateway
    {
        $this->authorizationToken = $authorizationToken;
        return $this;
    }

    /**
     * Authenticate the user with provided credentials.
     *
     * @param array $parameters
     * @return AuthenticateRequest
     */
    public function authenticate(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(AuthenticateRequest::class, $parameters);
    }

    /**
     * Fetch customer by customer reference.
     *
     * @param array $parameters
     * @return FetchCustomerRequest
     */
    public function fetchCustomer(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(FetchCustomerRequest::class, $parameters);
    }

    /**
     * @inheritDoc
     */
    protected function createRequest($class, array $parameters)
    {
        $parameters = array_merge($parameters, [
            'production' => $this->production,
            'authorizationToken' => $this->authorizationToken,
        ]);
        return parent::createRequest($class, $parameters);
    }
}
