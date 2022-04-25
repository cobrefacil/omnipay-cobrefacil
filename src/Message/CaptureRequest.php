<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Capture invoice pre authorized.
 *
 * @link https://developers.cobrefacil.com.br/#capturar-cobranca-via-cartao
 */
class CaptureRequest extends AbstractInvoiceRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->getBaseUri() . '/invoices/' . $this->getTransactionReference() . '/capture';
    }

    public function getData()
    {
        $this->validate('transactionReference');
        return [
            'amount' => $this->getAmount(),
        ];
    }

    public function setAmount($value): CaptureRequest
    {
        return $this->setAmountInteger($value);
    }

    public function getAmount()
    {
        return $this->getAmountInteger();
    }
}
