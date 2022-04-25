<?php

namespace Omnipay\CobreFacil;

use Omnipay\Common\ParametersTrait;

class InvoiceInstallment
{
    use ParametersTrait;

    const MODE_WITH_INTEREST = 'with_interest';
    const MODE_INTEREST_FREE = 'interest_free';

    public function __construct($parameters = [])
    {
        $this->initialize($parameters);
    }

    public function getNumber()
    {
        return $this->getParameter('installment.number');
    }

    public function setNumber($value): InvoiceInstallment
    {
        return $this->setParameter('installment.number', $value);
    }

    public function getMode()
    {
        return $this->getParameter('installment.mode');
    }

    public function setMode($value): InvoiceInstallment
    {
        return $this->setParameter('installment.mode', $value);
    }
}
