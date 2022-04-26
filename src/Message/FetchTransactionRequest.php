<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Fetch transaction by reference.
 *
 * https://developers.cobrefacil.com.br/#detalhar-cobranca
 */
class FetchTransactionRequest extends AbstractRequest
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
        return $this->getBaseUri() . '/invoices/' . $this->getReference();
    }
}
