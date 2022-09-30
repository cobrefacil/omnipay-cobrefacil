<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Cancel Subscription
 *
 * @link https://developers.cobrefacil.com.br/#pausar-mensalidades
 */
class PauseSubscriptionRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/subscriptions/' . $this->getReference() . '/pause';
    }

    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        if (isset($parameters['reactivate_at']) && !empty($parameters['reactivate_at'])) {
            $this->setReactivateAt($parameters['reactivate_at']);
        }
        return $this;
    }

    public function getData(): array
    {
        $this->validate('reference', 'reactivate_at');
        return [
            'reactivate_at' => $this->getReactivateAt(),
        ];
    }

    public function getReactivateAt(): ?string
    {
        return $this->getParameter('reactivate_at');
    }

    public function setReactivateAt(string $value): self
    {
        return $this->setParameter('reactivate_at', $value);
    }
}
