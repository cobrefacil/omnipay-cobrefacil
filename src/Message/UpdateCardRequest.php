<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Update card.
 *
 * https://developers.cobrefacil.com.br/#definir-cartao-padrao
 */
class UpdateCardRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/cards/' . $this->getReference() . '/default';
    }

    public function getData()
    {
        $this->validate('reference');
    }
}
