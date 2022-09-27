<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Fetch receivables.
 *
 * https://developers.cobrefacil.com.br/#detalhar-recebivel
 */
class FetchReceivableRequest extends AbstractRequest
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
        return $this->getBaseUri() . '/receivables/' . $this->getReference();
    }
}
