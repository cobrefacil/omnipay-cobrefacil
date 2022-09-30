<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Common\ItemBag;
use Omnipay\CobreFacil\InvoiceSettings;
use Omnipay\CobreFacil\SubscriptionItem;

abstract class AbstractSubscriptionRequest extends AbstractRequest
{
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        if (isset($parameters['reference'])) {
            $this->setReferenceField($parameters['reference']);
        }
        if (isset($parameters['items']) && is_array($parameters['items'])) {
            $items = [];
            foreach ($parameters['items'] as $item) {
                $items[] = new SubscriptionItem($item);
            }
            $this->setItems(new ItemBag($items));
        }
        if (isset($parameters['settings']) && is_array($parameters['settings'])) {
            $this->setSettings(new InvoiceSettings($parameters['settings']));
        }
        return $this;
    }

    public function getData()
    {
        $data = [];
        if ($this->getPayableWith()) {
            $data['payable_with'] = $this->getPayableWith();
        }
        if ($this->getCustomerId()) {
            $data['customer_id'] = $this->getCustomerId();
        }
        if ($this->getGenerateDays()) {
            $data['generate_days'] = $this->getGenerateDays();
        }
        if ($this->getIntervalSize()) {
            $data['interval_size'] = $this->getIntervalSize();
        }
        if ($this->getIntervalType()) {
            $data['interval_type'] = $this->getIntervalType();
        }
        if ($this->getNotificationRuleId()) {
            $data['notification_rule_id'] = $this->getNotificationRuleId();
        }
        if (!empty($this->getFirstDueDate())) {
            $data['first_due_date'] = $this->getFirstDueDate();
        }
        if (!empty($this->getNextExpiration())) {
            $data['next_expiration'] = $this->getNextExpiration();
        }
        if (!empty($this->getReferenceField())) {
            $data['reference'] = $this->getReferenceField();
        }
        if (!empty($this->getContractNumber())) {
            $data['contract_number'] = $this->getContractNumber();
        }
        if (!empty($this->getExpiresAt())) {
            $data['expires_at'] = $this->getExpiresAt();
        }
        $items = $this->getItems();
        if (!empty($items)) {
            foreach ($items as $item) {
                $data['items'][] = [
                    'products_services_id' => $item->getProductsServicesId(),
                    'quantity' => $item->getQuantity(),
                    'price' => $item->getPrice(),
                ];
            }
        }
        if (!empty($this->getPlansId()) && empty($items)) {
            $data['plans_id'] = $this->getPlansId();
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

    public function setPayableWith($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('payable_with', $value);
    }

    public function getCustomerId()
    {
        return $this->getParameter('customer_id');
    }

    public function setCustomerId($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('customer_id', $value);
    }

    public function getFirstDueDate()
    {
        return $this->getParameter('due_date');
    }

    public function setFirstDueDate($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('due_date', $value);
    }

    public function getSettings(): ?InvoiceSettings
    {
        return $this->getParameter('settings');
    }

    public function setSettings($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('settings', $value);
    }

    public function getGenerateDays()
    {
        return $this->getParameter('generate_days');
    }

    public function setGenerateDays($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('generate_days', $value);
    }

    public function getIntervalSize()
    {
        return $this->getParameter('interval_size');
    }

    public function setIntervalSize($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('interval_size', $value);
    }

    public function getIntervalType()
    {
        return $this->getParameter('interval_type');
    }

    public function setIntervalType($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('interval_type', $value);
    }

    public function getNotificationRuleId()
    {
        return $this->getParameter('notification_rule_id');
    }

    public function setNotificationRuleId($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('notification_rule_id', $value);
    }

    public function getNextExpiration()
    {
        return $this->getParameter('next_expiration');
    }

    public function setNextExpiration($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('next_expiration', $value);
    }

    public function getContractNumber()
    {
        return $this->getParameter('contract_number');
    }

    public function setContractNumber($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('contract_number', $value);
    }

    public function getExpiresAt()
    {
        return $this->getParameter('expires_at');
    }

    public function setExpiresAt($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('expires_at', $value);
    }

    public function getPlansId()
    {
        return $this->getParameter('plans_id');
    }

    public function setPlansId($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('plans_id', $value);
    }

    public function getReferenceField()
    {
        return $this->getParameter('reference_field');
    }

    public function setReferenceField($value): AbstractSubscriptionRequest
    {
        return $this->setParameter('reference_field', $value);
    }
}
