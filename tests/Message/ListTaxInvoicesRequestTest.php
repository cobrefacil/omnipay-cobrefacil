<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class ListTaxInvoicesRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new ListTaxInvoicesRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/tax-invoices',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/tax-invoices',
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
            ->setLimit(10)
            ->setOffset(1)
            ->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/tax-invoices?limit=10&offset=1',
            $this->request->getEndpoint()
        );
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ListTaxInvoicesSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }
}
