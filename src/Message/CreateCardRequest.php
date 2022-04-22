<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Create card.
 *
 * https://developers.cobrefacil.com.br/#criar-cartao
 */
class CreateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('customer_id', 'card');
        $card = $this->getCard();
        $card->validate();
        $data = [
            'customer_id' => $this->getCustomerId(),
            'name' => $card->getName(),
            'number' => $card->getNumber(),
            'expiration_month' => $card->getExpiryMonth(),
            'expiration_year' => $card->getExpiryYear(),
            'security_code' => $card->getCvv(),
        ];
        if (!empty($this->getDefault())) {
            $data['default'] = $this->getDefault();
        }
        return $data;
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/cards';
    }

    public function getCustomerId()
    {
        return $this->getParameter('customer_id');
    }

    public function setCustomerId($value): CreateCardRequest
    {
        return $this->setParameter('customer_id', $value);
    }

    public function getDefault()
    {
        return $this->getParameter('default');
    }

    public function setDefault($value): CreateCardRequest
    {
        return $this->setParameter('default', $value);
    }
}
