<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class PauseSubscriptionRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new PauseSubscriptionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setReference('GNX93QM18WQQ8KW6YVZO');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/subscriptions/GNX93QM18WQQ8KW6YVZO/pause',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/subscriptions/GNX93QM18WQQ8KW6YVZO/pause',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PauseSubscriptionSuccess.txt');
        $response = $this->request
            ->setReactivateAt(date('Y-m-d', strtotime('+1 days')))
            ->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }
}
