<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Delete card.
 *
 * https://developers.cobrefacil.com.br/#remover-cartao
 */
class DeleteCardRequest extends AbstractRequest
{
    public function getHttpMethod(): string
    {
        return 'DELETE';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/cards/' . $this->getReference();
    }

    public function getData()
    {
        $this->validate('reference');
    }
}
