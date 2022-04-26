<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Authorize an amount on the customers card.
 *
 * @link https://developers.cobrefacil.com.br/#autorizar-cobranca-via-cartao
 */
class AuthorizeRequest extends AbstractCreateInvoiceRequest
{
    public function getData()
    {
        $this->setPayableWith(PurchaseRequest::PAYMENT_METHOD_CREDIT);
        return parent::getData();
    }
}
