<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class CaptureRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new CaptureRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransactionReference('OY4Q3NVG7VD759PRLD60');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/invoices/OY4Q3NVG7VD759PRLD60/capture',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/invoices/OY4Q3NVG7VD759PRLD60/capture',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testWithoutData()
    {
        $data = $this->request->getData();
        $this->assertEmpty($data['amount']);
    }

    public function testWithData()
    {
        $this->request->setAmount(4290);
        $data = $this->request->getData();
        $this->assertSame(4290, $data['amount']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CaptureSuccess.txt');
        /** @var TransactionResponse $response */
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
        $this->setMockHttpResponse('CaptureFailure.txt');
        /** @var TransactionResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getData());
        $this->assertSame('Cobrança não encontrada.', $response->getMessage());
        $this->assertNull($response->getErrors());
    }
}
