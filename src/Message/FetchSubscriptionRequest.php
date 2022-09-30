<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Fetch subscription.
 *
 * https://developers.cobrefacil.com.br/#detalhar-mensalidades
 */
class FetchSubscriptionRequest extends AbstractRequest
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
        return $this->getBaseUri() . '/subscriptions/' . $this->getReference();
    }
}
