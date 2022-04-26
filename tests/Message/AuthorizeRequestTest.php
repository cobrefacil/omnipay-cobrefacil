<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\CobreFacil\InvoiceInstallment;
use Omnipay\CobreFacil\InvoiceSettings;
use Omnipay\Common\Item;
use Omnipay\Common\ItemBag;
use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/invoices',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/invoices',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testDataPassingOnlyItsId()
    {
        $item1 = (new Item())
            ->setDescription('Teclado')
            ->setQuantity(1)
            ->setPrice(49.99);
        $item2 = (new Item())
            ->setDescription('Mouse')
            ->setQuantity(2)
            ->setPrice(39.99);
        $this->request
            ->setTransactionId('100042')
            ->setCustomerId('Y73MNPGJ18Y18V5KQODX')
            ->setCreditCardId('E65OPXNV9D59WM7JL402')
            ->setCapture(true)
            ->setRequestIp('127.0.0.1')
            ->setInstallment(new InvoiceInstallment([
                'number' => 3,
                'mode' => InvoiceInstallment::MODE_INTEREST_FREE,
            ]))
            ->setItems(new ItemBag([$item1, $item2]))
            ->setSettings(new InvoiceSettings([
                'send_tax_invoice' => true,
            ]));
        $data = $this->request->getData();
        $this->assertSame('100042', $data['reference']);
        $this->assertSame(PurchaseRequest::PAYMENT_METHOD_CREDIT, $data['payable_with']);
        $this->assertSame('E65OPXNV9D59WM7JL402', $data['credit_card_id']);
        $this->assertSame(true, $data['capture']);
        $this->assertSame('127.0.0.1', $data['request_ip']);
        $this->assertSame(3, $data['installment']['number']);
        $this->assertSame(InvoiceInstallment::MODE_INTEREST_FREE, $data['installment']['mode']);
        $this->assertSame('Teclado', $data['items'][0]['description']);
        $this->assertSame(1, $data['items'][0]['quantity']);
        $this->assertSame(49.99, $data['items'][0]['price']);
        $this->assertSame('Mouse', $data['items'][1]['description']);
        $this->assertSame(2, $data['items'][1]['quantity']);
        $this->assertSame(39.99, $data['items'][1]['price']);
        $this->assertSame(true, $data['settings']['send_tax_invoice']);
    }

    public function testDataPassingAllItsData()
    {
        $card = $this->getValidCard();
        $item1 = (new Item())
            ->setDescription('Teclado')
            ->setQuantity(1)
            ->setPrice(49.99);
        $item2 = (new Item())
            ->setDescription('Mouse')
            ->setQuantity(2)
            ->setPrice(39.99);
        $this->request
            ->setTransactionId('100042')
            ->setCustomerId('Y73MNPGJ18Y18V5KQODX')
            ->setCreditCard($card)
            ->setCapture(true)
            ->setRequestIp('127.0.0.1')
            ->setInstallment(new InvoiceInstallment([
                'number' => 3,
                'mode' => InvoiceInstallment::MODE_INTEREST_FREE,
            ]))
            ->setItems(new ItemBag([$item1, $item2]))
            ->setSettings(new InvoiceSettings([
                'send_tax_invoice' => true,
            ]));
        $data = $this->request->getData();
        $this->assertSame('100042', $data['reference']);
        $this->assertSame(PurchaseRequest::PAYMENT_METHOD_CREDIT, $data['payable_with']);
        $this->assertSame($card['firstName'] . ' ' . $card['lastName'], $data['credit_card']['name']);
        $this->assertSame($card['number'], $data['credit_card']['number']);
        $this->assertSame($card['expiryMonth'], $data['credit_card']['expiration_month']);
        $this->assertSame($card['expiryYear'], $data['credit_card']['expiration_year']);
        $this->assertSame($card['cvv'], $data['credit_card']['security_code']);
        $this->assertSame(true, $data['capture']);
        $this->assertSame('127.0.0.1', $data['request_ip']);
        $this->assertSame(3, $data['installment']['number']);
        $this->assertSame(InvoiceInstallment::MODE_INTEREST_FREE, $data['installment']['mode']);
        $this->assertSame('Teclado', $data['items'][0]['description']);
        $this->assertSame(1, $data['items'][0]['quantity']);
        $this->assertSame(49.99, $data['items'][0]['price']);
        $this->assertSame('Mouse', $data['items'][1]['description']);
        $this->assertSame(2, $data['items'][1]['quantity']);
        $this->assertSame(39.99, $data['items'][1]['price']);
        $this->assertSame(true, $data['settings']['send_tax_invoice']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('AuthorizeSuccess.txt');
        /** @var InvoiceResponse $response */
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('100042', $response->getTransactionId());
        $this->assertSame('2KD9LGERW897NZ6JM5V4', $response->getTransactionReference());
        $this->assertSame($response->getId(), $response->getTransactionReference());
        $this->assertSame('pre_authorized', $response->getStatus());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('AuthorizeFailure.txt');
        /** @var InvoiceResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getData());
        $this->assertSame('Parâmetros inválidos.', $response->getMessage());
        $this->assertSame([
            'Data de vencimento deve ser uma data maior ou igual a hoje.',
        ], $response->getErrors());
    }
}
