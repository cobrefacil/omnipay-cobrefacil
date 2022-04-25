<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Create customer.
 *
 * https://developers.cobrefacil.com.br/#criar-cliente
 */
class CreateCustomerRequest extends AbstractCustomerWriteRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/customers';
    }
}
