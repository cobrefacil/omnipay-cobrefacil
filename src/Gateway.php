<?php

namespace Omnipay\CobreFacil;

use Omnipay\CobreFacil\Message\AuthenticateRequest;
use Omnipay\CobreFacil\Message\AuthenticateResponse;
use Omnipay\CobreFacil\Message\CaptureRequest;
use Omnipay\CobreFacil\Message\CreateCardRequest;
use Omnipay\CobreFacil\Message\CreateCustomerRequest;
use Omnipay\CobreFacil\Message\CreateInvoiceRequest;
use Omnipay\CobreFacil\Message\DeleteCardRequest;
use Omnipay\CobreFacil\Message\DeleteCustomerRequest;
use Omnipay\CobreFacil\Message\FetchCustomerRequest;
use Omnipay\CobreFacil\Message\ListCustomersRequest;
use Omnipay\CobreFacil\Message\UpdateCardRequest;
use Omnipay\CobreFacil\Message\UpdateCustomerRequest;
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
     * Create customer.
     *
     * @param array $parameters
     * @return CreateCustomerRequest
     */
    public function createCustomer(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(CreateCustomerRequest::class, $parameters);
    }

    /**
     * Update customer.
     *
     * @param array $parameters
     * @return UpdateCustomerRequest
     */
    public function updateCustomer(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(UpdateCustomerRequest::class, $parameters);
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
     * List customers.
     *
     * @param array $parameters
     * @return ListCustomersRequest
     */
    public function listCustomers(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(ListCustomersRequest::class, $parameters);
    }

    /**
     * Delete customer.
     *
     * @param array $parameters
     * @return DeleteCustomerRequest
     */
    public function deleteCustomer(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(DeleteCustomerRequest::class, $parameters);
    }

    /**
     * Create card.
     *
     * @param array $options
     * @return CreateCardRequest
     */
    public function createCard(array $options = []): AbstractRequest
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    /**
     * Update card.
     *
     * @param array $options
     * @return UpdateCardRequest
     */
    public function updateCard(array $options = []): AbstractRequest
    {
        return $this->createRequest(UpdateCardRequest::class, $options);
    }

    /**
     * Delete card.
     *
     * @param array $options
     * @return DeleteCardRequest
     */
    public function deleteCard(array $options = []): AbstractRequest
    {
        return $this->createRequest(DeleteCardRequest::class, $options);
    }

    /**
     * Create invoice.
     *
     * @param array $options
     * @return CreateInvoiceRequest
     */
    public function createInvoice(array $options = []): AbstractRequest
    {
        return $this->createRequest(CreateInvoiceRequest::class, $options);
    }

    /**
     * Capture invoice pre authorized.
     *
     * @param array $options
     * @return CaptureRequest
     */
    public function capture(array $options = []): AbstractRequest
    {
        return $this->createRequest(CaptureRequest::class, $options);
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
