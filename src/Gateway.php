<?php

namespace Omnipay\CobreFacil;

use Omnipay\CobreFacil\Message\AuthenticateRequest;
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
     * @inheritdoc
     */
    public function getName()
    {
        return 'Cobre Fácil';
    }

    /**
     * Authenticate the user with provided credentials.
     */
    public function authenticate(array $parameters = []): AbstractRequest
    {
        return $this->createRequest(AuthenticateRequest::class, $parameters);
    }
}
