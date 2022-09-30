<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Create Subscription
 *
 * @link https://developers.cobrefacil.com.br/#criar-mensalidades
 */
class CreateSubscriptionRequest extends AbstractSubscriptionRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/subscriptions';
    }

    public function getData(): array
    {
        $this->validate(
            'payable_with',
            'customer_id',
            'generate_days',
            'interval_size',
            'interval_type',
            'notification_rule_id'
        );
        return parent::getData();
    }
}
