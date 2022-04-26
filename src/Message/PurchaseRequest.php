<?php

namespace Omnipay\CobreFacil\Message;

/**
 * Create invoice.
 *
 * @link https://developers.cobrefacil.com.br/#criar-cobranca-via-boleto
 * @link https://developers.cobrefacil.com.br/#criar-cobranca-via-pix
 * @link https://developers.cobrefacil.com.br/#autorizar-cobranca-via-cartao
 */
class PurchaseRequest extends AbstractCreateInvoiceRequest
{
    const PAYMENT_METHOD_BANKSLIP = 'bankslip';
    const PAYMENT_METHOD_CREDIT = 'credit';
    const PAYMENT_METHOD_PIX = 'pix';
}
