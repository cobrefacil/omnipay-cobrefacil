<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Cancel invoice card.
 *
 * https://developers.cobrefacil.com.br/#cancelar-cobranca
 */
class CancelInvoiceRequest extends AbstractInvoiceRequest
{
    public function getHttpMethod(): string
    {
        return 'DELETE';
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/invoices/' . $this->getTransactionReference();
    }

    public function getData()
    {
        $this->validate('transactionReference');
    }
}
