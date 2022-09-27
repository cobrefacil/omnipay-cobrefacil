<?php

namespace Omnipay\CobreFacil\Message;

/**
 * List receivables.
 *
 * https://developers.cobrefacil.com.br/#listar-recebiveis-por-cobranca
 */
class ListReceivablesRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('reference');
        $data = [];
        if ($this->getId()) {
            $data['id'] = $this->getId();
        }
        return $data;
    }

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/invoices/' . $this->getReference() . '/receivables' . $this->getQueryParams();
    }

    public function getId()
    {
        return $this->getParameter('id');
    }

    public function setId($value): ListReceivablesRequest
    {
        return $this->setParameter('id', $value);
    }
}
