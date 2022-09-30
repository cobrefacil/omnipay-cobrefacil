<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Cancel Subscription
 *
 * @link https://developers.cobrefacil.com.br/#cancelar-mensalidades
 */
class CancelSubscriptionRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/subscriptions/' . $this->getReference() . '/cancel';
    }

    public function getData(): array
    {
        $this->validate('reference');
        return [];
    }
}
