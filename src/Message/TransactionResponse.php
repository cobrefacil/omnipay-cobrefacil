<?php

namespace Omnipay\CobreFacil\Message;

class TransactionResponse extends Response
{
    public function getTransactionId()
    {
        if (!$this->isSuccessful()) {
            return null;
        }
        return $this->getData()['reference'] ?? null;
    }

    public function getTransactionReference()
    {
        return $this->getId();
    }

    public function getStatus()
    {
        if (!$this->isSuccessful()) {
            return null;
        }
        return $this->getData()['status'];
    }
}
