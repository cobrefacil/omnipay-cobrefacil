<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class FetchSubscriptionRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchSubscriptionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setReference('KWMZP7RVEQGD83D4Y5O9');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/subscriptions/KWMZP7RVEQGD83D4Y5O9',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/subscriptions/KWMZP7RVEQGD83D4Y5O9',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('GET', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchSubscriptionSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }
}
