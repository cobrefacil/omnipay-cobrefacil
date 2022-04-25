<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Refund invoice.
 *
 * @link https://developers.cobrefacil.com.br/#estornar-cobranca-via-cartao
 */
class RefundRequest extends AbstractInvoiceRequest
{
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/invoices/' . $this->getTransactionReference() . '/refund';
    }

    public function getData()
    {
        $this->validate('transactionReference');
        return [
            'amount' => $this->getAmount(),
        ];
    }

    public function setAmount($value): RefundRequest
    {
        return $this->setAmountInteger($value);
    }

    public function getAmount()
    {
        return $this->getAmountInteger();
    }
}
