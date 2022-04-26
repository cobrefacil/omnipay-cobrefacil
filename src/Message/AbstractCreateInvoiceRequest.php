<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\CobreFacil\InvoiceInstallment;
use Omnipay\CobreFacil\InvoiceSettings;

abstract class AbstractCreateInvoiceRequest extends AbstractInvoiceRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/invoices';
    }

    public function getData()
    {
        $data = [
            'payable_with' => $this->getPayableWith(),
            'customer_id' => $this->getCustomerId(),
            'due_date' => $this->getDueDate(),
        ];
        if (!empty($this->getTransactionId())) {
            $data['reference'] = $this->getTransactionId();
        }
        $items = $this->getItems();
        if (!empty($items)) {
            foreach ($items as $item) {
                $data['items'][] = [
                    'description' => $item->getDescription(),
                    'quantity' => $item->getQuantity(),
                    'price' => $item->getPrice(),
                ];
            }
        }
        if (!empty($this->getCreditCardId())) {
            $data['credit_card_id'] = $this->getCreditCardId();
        }
        if (!empty($this->getCreditCard())) {
            $card = $this->getCreditCard();
            $data['credit_card'] = [
                'name' => $card['firstName'] . ' ' . $card['lastName'],
                'number' => $card['number'],
                'expiration_month' => $card['expiryMonth'],
                'expiration_year' => $card['expiryYear'],
                'security_code' => $card['cvv'],
            ];
        }
        if (!empty($this->getCapture())) {
            $data['capture'] = $this->getCapture();
        }
        if (!empty($this->getRequestIp())) {
            $data['request_ip'] = $this->getRequestIp();
        }
        if (!empty($this->getInstallment())) {
            $installment = $this->getInstallment();
            $data['installment'] = [
                'number' => $installment->getNumber(),
                'mode' => $installment->getMode(),
            ];
        }
        if (!empty($this->getSettings())) {
            $settings = $this->getSettings();
            if (!empty($settings->getLateFeeMode())) {
                $data['settings']['late_fee']['mode'] = $settings->getLateFeeMode();
            }
            if (!empty($settings->getLateFeeAmount())) {
                $data['settings']['late_fee']['amount'] = $settings->getLateFeeAmount();
            }
            if (!empty($settings->getInterestMode())) {
                $data['settings']['interest']['mode'] = $settings->getInterestMode();
            }
            if (!empty($settings->getInterestAmount())) {
                $data['settings']['interest']['amount'] = $settings->getInterestAmount();
            }
            if (!empty($settings->getDiscountMode())) {
                $data['settings']['discount']['mode'] = $settings->getDiscountMode();
            }
            if (!empty($settings->getDiscountAmount())) {
                $data['settings']['discount']['amount'] = $settings->getDiscountAmount();
            }
            if (!empty($settings->getDiscountLimitDate())) {
                $data['settings']['discount']['limit_date'] = $settings->getDiscountLimitDate();
            }
            if (!empty($settings->getWarningDescription())) {
                $data['settings']['warning']['description'] = $settings->getWarningDescription();
            }
            if (!empty($settings->getSendTaxInvoice())) {
                $data['settings']['send_tax_invoice'] = $settings->getSendTaxInvoice();
            }
        }
        return $data;
    }

    public function getPayableWith()
    {
        return $this->getParameter('payable_with');
    }

    public function setPayableWith($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('payable_with', $value);
    }

    public function getCustomerId()
    {
        return $this->getParameter('customer_id');
    }

    public function setCustomerId($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('customer_id', $value);
    }

    public function getCreditCard()
    {
        return $this->getParameter('credit_card');
    }

    public function setCreditCard($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('credit_card', $value);
    }

    public function getCreditCardId()
    {
        return $this->getParameter('credit_card_id');
    }

    public function setCreditCardId($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('credit_card_id', $value);
    }

    public function getCapture()
    {
        return $this->getParameter('capture');
    }

    public function setCapture($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('capture', $value);
    }

    public function getRequestIp()
    {
        return $this->getParameter('request_ip');
    }

    public function setRequestIp($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('request_ip', $value);
    }

    public function getInstallment(): ?InvoiceInstallment
    {
        return $this->getParameter('installment');
    }

    public function setInstallment($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('installment', $value);
    }

    public function getDueDate()
    {
        return $this->getParameter('due_date');
    }

    public function setDueDate($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('due_date', $value);
    }

    public function getSettings(): ?InvoiceSettings
    {
        return $this->getParameter('settings');
    }

    public function setSettings($value): AbstractCreateInvoiceRequest
    {
        return $this->setParameter('settings', $value);
    }
}
