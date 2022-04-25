<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class DeleteCustomerRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new DeleteCustomerRequest($this->getHttpClient(), $this->getHttpRequest());
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
        $this->assertSame('DELETE', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('DeleteCustomerSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Y73MNPGJ18Y18V5KQODX', $response->getId());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('DeleteCustomerFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getId());
        $this->assertNull($response->getData());
        $this->assertSame('Cliente não encontrado.', $response->getMessage());
        $this->assertEmpty($response->getErrors());
    }
}
