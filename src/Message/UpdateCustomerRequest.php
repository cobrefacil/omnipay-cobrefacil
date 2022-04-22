<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Update customer.
 *
 * https://developers.cobrefacil.com.br/#atualizar-cliente
 */
class UpdateCustomerRequest extends AbstractCustomerWriteRequest
{
    public function getHttpMethod(): string
    {
        return 'PUT';
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
        return parent::getData();
    }
}
