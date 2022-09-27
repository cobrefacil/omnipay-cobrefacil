<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class ListReceivablesRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new ListReceivablesRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setReference('RP528EJKXG2EXY60OZLN');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/invoices/RP528EJKXG2EXY60OZLN/receivables',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/invoices/RP528EJKXG2EXY60OZLN/receivables',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('GET', $this->request->getHttpMethod());
    }

    public function testEndpointWithFilters()
    {
        $this->request
            ->setTestMode(true)
            ->setId('P28EM9YZL87J4KV6GO0R');
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/invoices/RP528EJKXG2EXY60OZLN/receivables?id=P28EM9YZL87J4KV6GO0R',
            $this->request->getEndpoint()
        );
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ListReceivablesSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('ListReceivablesFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertNull($response->getId());
        $this->assertSame('Nenhum resultado encontrado.', $response->getMessage());
    }
}
