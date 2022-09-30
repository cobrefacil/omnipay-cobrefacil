<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class GenerateSubscriptionInvoiceRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new GenerateSubscriptionInvoiceRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setReference('D1P956ZMEOD307WV4O32');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/subscriptions/D1P956ZMEOD307WV4O32/generate-invoice',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/subscriptions/D1P956ZMEOD307WV4O32/generate-invoice',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('GenerateSubscriptionInvoiceSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }
}
