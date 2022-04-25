<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class UpdateCardRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new UpdateCardRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setReference('E65OPXNV9D59WM7JL402');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/cards/E65OPXNV9D59WM7JL402/default',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/cards/E65OPXNV9D59WM7JL402/default',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('UpdateCardSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('E65OPXNV9D59WM7JL402', $response->getId());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('UpdateCardFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getId());
        $this->assertNull($response->getData());
        $this->assertSame('Nenhum resultado encontrado.', $response->getMessage());
    }
}
