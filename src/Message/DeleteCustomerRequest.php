<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Delete customer.
 *
 * https://developers.cobrefacil.com.br/#atualizar-cliente
 */
class DeleteCustomerRequest extends AbstractCustomerWriteRequest
{
    public function getHttpMethod(): string
    {
        return 'DELETE';
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/customers/' . $this->getReference();
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate('reference');
    }
}
