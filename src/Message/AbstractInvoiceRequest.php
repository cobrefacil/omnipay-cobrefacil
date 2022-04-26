<?php

namespace Omnipay\CobreFacil\Message;

abstract class AbstractInvoiceRequest extends AbstractRequest
{
    protected function createResponse(string $data): Response
    {
        return $this->response = new TransactionResponse($this, $data);
    }
}
