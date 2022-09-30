<?php

namespace Omnipay\CobreFacil;

use Omnipay\Common\AbstractGateway;
use Omnipay\CobreFacil\Message\VoidRequest;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\CobreFacil\Message\RefundRequest;
use Omnipay\CobreFacil\Message\CaptureRequest;
use Omnipay\CobreFacil\Message\PurchaseRequest;
use Omnipay\CobreFacil\Message\CreateCardRequest;
use Omnipay\CobreFacil\Message\DeleteCardRequest;
use Omnipay\CobreFacil\Message\UpdateCardRequest;
use Omnipay\CobreFacil\Message\AuthenticateRequest;
use Omnipay\CobreFacil\Message\AuthenticateResponse;
use Omnipay\CobreFacil\Message\FetchCustomerRequest;
use Omnipay\CobreFacil\Message\ListCustomersRequest;
use Omnipay\CobreFacil\Message\CreateCustomerRequest;
use Omnipay\CobreFacil\Message\DeleteCustomerRequest;
use Omnipay\CobreFacil\Message\UpdateCustomerRequest;
use Omnipay\CobreFacil\Message\FetchReceivableRequest;
use Omnipay\CobreFacil\Message\ListReceivablesRequest;
use Omnipay\CobreFacil\Message\FetchTransactionRequest;
use Omnipay\CobreFacil\Message\PauseSubscriptionRequest;
use Omnipay\CobreFacil\Message\CancelSubscriptionRequest;
use Omnipay\CobreFacil\Message\CreateSubscriptionRequest;
use Omnipay\CobreFacil\Message\UpdateSubscriptionRequest;
use Omnipay\CobreFacil\Exception\InvalidCredentialsException;
use Omnipay\CobreFacil\Message\GenerateSubscriptionInvoiceRequest;

/**
 * Cobre Fácil Gateway
 *
 * @link https://developers.cobrefacil.com.br
 */
class Gateway extends AbstractGateway
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Cobre Fácil';
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->getParameter('app_id');
    }

    /**
     * @param string $value
     * @return Gateway
     */
    public function setAppId(string $value): Gateway
    {
        return $this->setParameter('app_id', $value);
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->getParameter('secret');
    }

    /**
     * @param string $value
     * @return Gateway
     */
    public function setSecret(string $value): Gateway
    {
        return $this->setParameter('secret', $value);
    }

    /**
     * @return string|null
     */
    public function getAuthorizationToken(): ?string
    {
        return $this->getParameter('authorizationToken');
    }

    /**
     * @param string $value
     * @return Gateway
     */
    public function setAuthorizationToken(string $value): Gateway
    {
        return $this->setParameter('authorizationToken', $value);
    }

    /**
     * Authenticate the user with provided credentials.
     *
     * @param array $parameters
     * @return AuthenticateRequest
     * @throws InvalidCredentialsException
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
     * @throws InvalidCredentialsException
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
     * @throws InvalidCredentialsException
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
     * @throws InvalidCredentialsException
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
     * @throws InvalidCredentialsException
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
     * @throws InvalidCredentialsException
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
     * @throws InvalidCredentialsException
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
     * @throws InvalidCredentialsException
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
     * @throws InvalidCredentialsException
     */
    public function deleteCard(array $options = []): AbstractRequest
    {
        return $this->createRequest(DeleteCardRequest::class, $options);
    }

    /**
     * Authorize an amount on the customers card.
     *
     * @param array $options
     * @return PurchaseRequest
     * @throws InvalidCredentialsException
     */
    public function authorize(array $options = []): AbstractRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Capture invoice pre authorized.
     *
     * @param array $options
     * @return CaptureRequest
     * @throws InvalidCredentialsException
     */
    public function capture(array $options = []): AbstractRequest
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    /**
     * Create invoice.
     *
     * @param array $options
     * @return PurchaseRequest
     * @throws InvalidCredentialsException
     */
    public function purchase(array $options = []): AbstractRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Refund invoice.
     *
     * @param array $options
     * @return RefundRequest
     * @throws InvalidCredentialsException
     */
    public function refund(array $options = []): AbstractRequest
    {
        return $this->createRequest(RefundRequest::class, $options);
    }

    /**
     * Fetch receivables.
     *
     * @param array $options
     * @return FetchReceivableRequest
     * @throws InvalidCredentialsException
     */
    public function fetchReceivable(array $options = []): AbstractRequest
    {
        return $this->createRequest(FetchReceivableRequest::class, $options);
    }

    /**
     * List receivables.
     *
     * @param array $parameters
     * @return ListReceivablesRequest
     * @throws InvalidCredentialsException
     */
    public function listReceivables(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(ListReceivablesRequest::class, $parameters);
    }
    
    /**
     * Create Subscription.
     *
     * @param array $parameters
     * @return CreateSubscriptionRequest
     * @throws InvalidCredentialsException
     */
    public function createSubscription(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(CreateSubscriptionRequest::class, $parameters);
    }

    /**
     * Update Subscription.
     *
     * @param array $parameters
     * @return UpdateSubscriptionRequest
     * @throws InvalidCredentialsException
     */
    public function updateSubscription(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(UpdateSubscriptionRequest::class, $parameters);
    }

    /**
     * Cancel Subscription.
     *
     * @param array $options
     * @return CancelSubscriptionRequest
     * @throws InvalidCredentialsException
     */
    public function cancelSubscription(array $options = []): AbstractRequest
    {
        return $this->createRequest(CancelSubscriptionRequest::class, $options);
    }

    /**
     * Pause Subscription.
     *
     * @param array $options
     * @return PauseSubscriptionRequest
     * @throws InvalidCredentialsException
     */
    public function pauseSubscription(array $options = []): AbstractRequest
    {
        return $this->createRequest(PauseSubscriptionRequest::class, $options);
    }

    /**
     * Generate Subscription Invoice.
     *
     * @param array $options
     * @return GenerateSubscriptionInvoiceRequest
     * @throws InvalidCredentialsException
     */
    public function generateSubscriptionInvoice(array $options = []): AbstractRequest
    {
        return $this->createRequest(GenerateSubscriptionInvoiceRequest::class, $options);
    }

    /**
     * Fetch Subscription.
     *
     * @param array $options
     * @return FetchSubscriptionRequest
     * @throws InvalidCredentialsException
     */
    public function fetchSubscription(array $options = []): AbstractRequest
    {
        return $this->createRequest(FetchSubscriptionRequest::class, $options);
    }

    /**
     * List Subscriptions.
     *
     * @param array $parameters
     * @return ListSubscriptionsRequest
     * @throws InvalidCredentialsException
     */
    public function listSubscriptions(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(ListSubscriptionsRequest::class, $parameters);
    }

    /**
     * Cancel invoice.
     *
     * @param array $options
     * @return VoidRequest
     * @throws InvalidCredentialsException
     */
    public function void(array $options = []): AbstractRequest
    {
        return $this->createRequest(VoidRequest::class, $options);
    }

    /**
     * Fetch transaction by reference.
     *
     * @param array $options
     * @return FetchTransactionRequest
     * @throws InvalidCredentialsException
     */
    public function fetchTransaction(array $options = []): AbstractRequest
    {
        return $this->createRequest(FetchTransactionRequest::class, $options);
    }

    /**
     * @param string $class
     * @param array $parameters
     * @return AbstractRequest
     * @throws InvalidCredentialsException
     */
    protected function createRequest($class, array $parameters)
    {
        if (AuthenticateRequest::class !== $class && empty($this->getAuthorizationToken())) {
            $this->authenticateWithParameters($parameters);
        }
        return parent::createRequest($class, $parameters);
    }

    /**
     * @param array $parameters
     * @return void
     * @throws InvalidCredentialsException
     */
    private function authenticateWithParameters(array $parameters): void
    {
        /** @var AuthenticateResponse $authenticateResponse */
        $authenticateResponse = $this->authenticate($parameters)->send();
        if (!$authenticateResponse->isSuccessful()) {
            throw new InvalidCredentialsException($authenticateResponse->getMessage());
        }
        $this->setAuthorizationToken($authenticateResponse->getToken());
    }
}
