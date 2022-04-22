<?php

namespace Omnipay\CobreFacil\Message;

/**
 * List customers.
 *
 * https://developers.cobrefacil.com.br/#listar-clientes
 */
class ListCustomersRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [];
        if ($this->getTaxpayerId()) {
            $data['taxpayer_id'] = $this->getTaxpayerId();
        }
        if ($this->getEin()) {
            $data['ein'] = $this->getEin();
        }
        if ($this->getEmail()) {
            $data['email'] = $this->getEmail();
        }
        if ($this->getPersonalName()) {
            $data['personal_name'] = $this->getPersonalName();
        }
        if ($this->getCompanyName()) {
            $data['company_name'] = $this->getCompanyName();
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
        return $this->endpoint . '/customers' . $this->getQueryParams();
    }

    public function getTaxpayerId()
    {
        return $this->getParameter('taxpayer_id');
    }

    public function setTaxpayerId($value): ListCustomersRequest
    {
        return $this->setParameter('taxpayer_id', $value);
    }

    public function getEin()
    {
        return $this->getParameter('ein');
    }

    public function setEin($value): ListCustomersRequest
    {
        return $this->setParameter('ein', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value): ListCustomersRequest
    {
        return $this->setParameter('email', $value);
    }

    public function getPersonalName()
    {
        return $this->getParameter('personal_name');
    }

    public function setPersonalName($value): ListCustomersRequest
    {
        return $this->setParameter('personal_name', $value);
    }

    public function getCompanyName()
    {
        return $this->getParameter('company_name');
    }

    public function setCompanyName($value): ListCustomersRequest
    {
        return $this->setParameter('company_name', $value);
    }

    public function getSortBy()
    {
        return $this->getParameter('sort_by');
    }

    public function setSortBy($value): ListCustomersRequest
    {
        return $this->setParameter('sort_by', $value);
    }

    public function getOrderBy()
    {
        return $this->getParameter('order_by');
    }

    public function setOrderBy($value): ListCustomersRequest
    {
        return $this->setParameter('order_by', $value);
    }

    public function getLimit()
    {
        return $this->getParameter('limit');
    }

    public function setLimit($value): ListCustomersRequest
    {
        return $this->setParameter('limit', $value);
    }

    public function getOffset()
    {
        return $this->getParameter('offset');
    }

    public function setOffset($value): ListCustomersRequest
    {
        return $this->setParameter('offset', $value);
    }
}
