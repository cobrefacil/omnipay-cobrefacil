<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Authenticate.
 *
 * @link https://developers.cobrefacil.com.br/#autenticacao
 */
class AuthenticateRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate('app_id', 'secret');
        return [
            'app_id' => $this->getAppId(),
            'secret' => $this->getSecret(),
        ];
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/authenticate';
    }

    public function getAppId(): string
    {
        return $this->getParameter('app_id');
    }

    public function setAppId(string $value): AuthenticateRequest
    {
        return $this->setParameter('app_id', $value);
    }

    public function getSecret(): string
    {
        return $this->getParameter('secret');
    }

    public function setSecret(string $value): AuthenticateRequest
    {
        return $this->setParameter('secret', $value);
    }

    protected function createResponse(string $data): Response
    {
        return $this->response = new AuthenticateResponse($this, $data);
    }
}
