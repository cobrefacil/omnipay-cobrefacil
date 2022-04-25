<?php

namespace Omnipay\CobreFacil\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const BASE_URI_SANDBOX = 'https://api.sandbox.cobrefacil.com.br/v1';
    const BASE_URI_PRODUCTION = 'https://api.cobrefacil.com.br/v1';

    /**
     * @var string|null
     */
    protected $authorizationToken;

    public function getBaseUri()
    {
        return $this->getTestMode() ? self::BASE_URI_SANDBOX : self::BASE_URI_PRODUCTION;
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
        $body = 'GET' === $this->getHttpMethod() ? null : json_encode($data);
        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $this->getHeaders(),
            $body
        );
        return $this->createResponse($httpResponse->getBody()->getContents());
    }

    public function getQueryParams(): ?string
    {
        $data = $this->getData();
        return empty($data) ? null : '?' . http_build_query($data);
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
