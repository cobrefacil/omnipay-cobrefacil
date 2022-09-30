<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Cancel Subscription
 *
 * @link https://developers.cobrefacil.com.br/#gerar-cobranca-mensalidades
 */
class GenerateSubscriptionInvoiceRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/subscriptions/' . $this->getReference() . '/generate-invoice';
    }

    public function getData(): array
    {
        $this->validate('reference');
        return [];
    }
}
