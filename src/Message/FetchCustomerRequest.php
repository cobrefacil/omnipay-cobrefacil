<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Fetch customer by customer reference.
 *
 * https://developers.cobrefacil.com.br/#detalhar-cliente
 */
class FetchCustomerRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('reference');
    }

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/customers/' . $this->getReference();
    }
}
