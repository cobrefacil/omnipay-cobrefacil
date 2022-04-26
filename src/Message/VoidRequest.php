<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Cancel invoice card.
 *
 * https://developers.cobrefacil.com.br/#cancelar-cobranca
 */
class VoidRequest extends AbstractInvoiceRequest
{
    public function getHttpMethod(): string
    {
        return 'DELETE';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/invoices/' . $this->getTransactionReference();
    }

    public function getData()
    {
        $this->validate('transactionReference');
    }
}
