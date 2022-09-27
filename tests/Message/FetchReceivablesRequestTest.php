<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class FetchReceivablesRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchReceivableRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setReference('P28EM9YZL87J4KV6GO0R');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/receivables/P28EM9YZL87J4KV6GO0R',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/receivables/P28EM9YZL87J4KV6GO0R',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('GET', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchReceivablesSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('FetchReceivablesFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertNull($response->getId());
        $this->assertSame('Nenhum resultado encontrado.', $response->getMessage());
    }
}
