<?php

namespace Omnipay\CobreFacil;

use Omnipay\CobreFacil\Traits\ParseNestedParams;
use Omnipay\Common\ParametersTrait;

class InvoiceSettings
{
    use ParametersTrait;
    use ParseNestedParams;

    const LATE_FEE_MODE_PERCENTAGE = 'percentage';
    const LATE_FEE_MODE_FIXED = 'fixed';
    const INTEREST_MONTHLY_PERCENTAGE = 'monthly_percentage';
    const INTEREST_DAILY_PERCENTAGE = 'daily_percentage';
    const INTEREST_DAILY_AMOUNT = 'daily_amount';
    const DISCOUNT_MODE_PERCENTAGE = 'percentage';
    const DISCOUNT_MODE_FIXED = 'fixed';

    public function __construct($parameters = [])
    {
        $this->initialize($parameters);
        $this->parseNestedParams($parameters);
    }

    public function getLateFeeMode()
    {
        return $this->getParameter('late_fee.mode');
    }

    public function setLateFeeMode($value): InvoiceSettings
    {
        return $this->setParameter('late_fee.mode', $value);
    }

    public function getLateFeeAmount()
    {
        return $this->getParameter('late_fee.amount');
    }

    public function setLateFeeAmount($value): InvoiceSettings
    {
        return $this->setParameter('late_fee.amount', $value);
    }

    public function getInterestMode()
    {
        return $this->getParameter('interest.mode');
    }

    public function setInterestMode($value): InvoiceSettings
    {
        return $this->setParameter('interest.mode', $value);
    }

    public function getInterestAmount()
    {
        return $this->getParameter('interest.amount');
    }

    public function setInterestAmount($value): InvoiceSettings
    {
        return $this->setParameter('interest.amount', $value);
    }

    public function getDiscountMode()
    {
        return $this->getParameter('discount.mode');
    }

    public function setDiscountMode($value): InvoiceSettings
    {
        return $this->setParameter('discount.mode', $value);
    }

    public function getDiscountAmount()
    {
        return $this->getParameter('discount.amount');
    }

    public function setDiscountAmount($value): InvoiceSettings
    {
        return $this->setParameter('discount.amount', $value);
    }

    public function getDiscountLimitDate()
    {
        return $this->getParameter('discount.limit_date');
    }

    public function setDiscountLimitDate($value): InvoiceSettings
    {
        return $this->setParameter('discount.limit_date', $value);
    }

    public function getWarningDescription()
    {
        return $this->getParameter('warning.description');
    }

    public function setWarningDescription($value): InvoiceSettings
    {
        return $this->setParameter('warning.description', $value);
    }

    public function getSendTaxInvoice()
    {
        return $this->getParameter('send_tax_invoice');
    }

    public function setSendTaxInvoice($value): InvoiceSettings
    {
        return $this->setParameter('send_tax_invoice', $value);
    }
}
