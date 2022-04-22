<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class ListCustomersRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new ListCustomersRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/customers',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setProduction(false);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/customers',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointWithFilters()
    {
        $this->request
            ->setProduction(true)
            ->setTaxpayerId('123456789')
            ->setEin('987654321')
            ->setEmail('customer@mail.com')
            ->setPersonalName('New Customer')
            ->setCompanyName('New Company')
            ->setLimit(10)
            ->setOffset(1);
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/customers?taxpayer_id=123456789&ein=987654321&email=customer%40mail.com&personal_name=New+Customer&company_name=New+Company&limit=10&offset=1',
            $this->request->getEndpoint()
        );
    }

    public function testData()
    {
        $this->request
            ->setTaxpayerId('123456789')
            ->setEin('987654321')
            ->setEmail('customer@mail.com')
            ->setPersonalName('New Customer')
            ->setCompanyName('New Company')
            ->setLimit(10)
            ->setOffset(1);
        $data = $this->request->getData();
        $this->assertSame('123456789', $data['taxpayer_id']);
        $this->assertSame('987654321', $data['ein']);
        $this->assertSame('customer@mail.com', $data['email']);
        $this->assertSame('New Customer', $data['personal_name']);
        $this->assertSame('New Company', $data['company_name']);
        $this->assertSame(10, $data['limit']);
        $this->assertSame(1, $data['offset']);
    }

    public function testHttpMethod()
    {
        $this->assertSame('GET', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ListCustomersSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('ListCustomersFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertNull($response->getReference());
        $this->assertSame('Cliente não encontrado.', $response->getMessage());
    }
}
