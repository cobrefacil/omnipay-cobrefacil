<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Update Subscription
 *
 * @link https://developers.cobrefacil.com.br/#atualizar-mensalidades
 */
class UpdateSubscriptionRequest extends AbstractSubscriptionRequest
{
    public function getHttpMethod(): string
    {
        return 'PUT';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/subscriptions/' . $this->getReference();
    }

    public function getData(): array
    {
        $this->validate(
            'reference',
            'next_expiration',
            'payable_with'
        );
        return parent::getData();
    }
}
