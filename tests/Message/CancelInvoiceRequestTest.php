<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class CancelInvoiceRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new CancelInvoiceRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransactionReference('OY4Q3NVG7VD759PRLD60');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/invoices/OY4Q3NVG7VD759PRLD60',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/invoices/OY4Q3NVG7VD759PRLD60',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('DELETE', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CancelInvoiceSuccess.txt');
        /** @var InvoiceResponse $response */
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionId());
        $this->assertSame('OY4Q3NVG7VD759PRLD60', $response->getTransactionReference());
        $this->assertSame($response->getId(), $response->getTransactionReference());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('CancelInvoiceFailure.txt');
        /** @var InvoiceResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getData());
        $this->assertSame('Cobrança não encontrada.', $response->getMessage());
    }
}
