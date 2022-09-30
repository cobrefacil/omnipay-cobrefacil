<?php

namespace Omnipay\CobreFacil\Message;

/**
 * List subscriptions.
 *
 * https://developers.cobrefacil.com.br/#listar-mensalidades
 */
class ListSubscriptionsRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [];
        if ($this->getStatus()) {
            $data['status'] = $this->getStatus();
        }
        if ($this->getSortBy()) {
            $data['sort_by'] = $this->getSortBy();
        }
        if ($this->getOrderBy()) {
            $data['order_by'] = $this->getOrderBy();
        }
        if ($this->getLimit()) {
            $data['limit'] = $this->getLimit();
        }
        if ($this->getOffset()) {
            $data['offset'] = $this->getOffset();
        }
        return $data;
    }

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/subscriptions' . $this->getQueryParams();
    }

    public function getStatus()
    {
        return $this->getParameter('status');
    }

    public function setStatus($value): ListSubscriptionsRequest
    {
        return $this->setParameter('status', $value);
    }

    public function getSortBy()
    {
        return $this->getParameter('sort_by');
    }

    public function setSortBy($value): ListSubscriptionsRequest
    {
        return $this->setParameter('sort_by', $value);
    }

    public function getOrderBy()
    {
        return $this->getParameter('order_by');
    }

    public function setOrderBy($value): ListSubscriptionsRequest
    {
        return $this->setParameter('order_by', $value);
    }

    public function getLimit()
    {
        return $this->getParameter('limit');
    }

    public function setLimit($value): ListSubscriptionsRequest
    {
        return $this->setParameter('limit', $value);
    }

    public function getOffset()
    {
        return $this->getParameter('offset');
    }

    public function setOffset($value): ListSubscriptionsRequest
    {
        return $this->setParameter('offset', $value);
    }
}
