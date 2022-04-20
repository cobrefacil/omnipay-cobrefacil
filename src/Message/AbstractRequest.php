<?php

namespace Omnipay\CobreFacil\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const BASE_URI_SANDBOX = 'https://api.sandbox.cobrefacil.com.br/v1';
    const BASE_URI_PRODUCTION = 'https://api.cobrefacil.com.br/v1';

    /**
     * @var bool
     */
    protected $production = true;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var string|null
     */
    protected $authorizationToken;

    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setEndpoint();
        return $this;
    }

    public function getProduction(): bool
    {
        return $this->production;
    }

    public function setProduction(bool $production): AbstractRequest
    {
        $this->production = $production;
        $this->setEndpoint();
        return $this;
    }

    public function setEndpoint(string $endpoint = null): AbstractRequest
    {
        $this->endpoint = $endpoint ?? $this->production ? self::BASE_URI_PRODUCTION : self::BASE_URI_SANDBOX;
        return $this;
    }

    abstract public function getEndpoint(): string;

    abstract public function getHttpMethod(): string;

    public function getHeaders(): array
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];
        if (!empty($this->authorizationToken)) {
            $headers['Authorization'] = 'Bearer ' . $this->authorizationToken;
        }
        return $headers;
    }

    public function getAuthorizationToken(): string
    {
        return $this->authorizationToken;
    }

    public function setAuthorizationToken(?string $authorizationToken): AbstractRequest
    {
        $this->authorizationToken = $authorizationToken;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function sendData($data)
    {
        $body = json_encode($data);
        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $this->getHeaders(),
            $body
        );
        return $this->createResponse($httpResponse->getBody()->getContents());
    }

    public function getReference(): ?string
    {
        return $this->getParameter('reference');
    }

    public function setReference(string $value): AbstractRequest
    {
        return $this->setParameter('reference', $value);
    }

    protected function createResponse(string $data): Response
    {
        return $this->response = new Response($this, $data);
    }
}
