<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class FetchCustomerRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchCustomerRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setReference('Y73MNPGJ18Y18V5KQODX');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/customers/Y73MNPGJ18Y18V5KQODX',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/customers/Y73MNPGJ18Y18V5KQODX',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('GET', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchCustomerSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('Y73MNPGJ18Y18V5KQODX', $response->getId());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('FetchCustomerFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertNull($response->getId());
        $this->assertSame('Cliente não encontrado.', $response->getMessage());
    }
}
