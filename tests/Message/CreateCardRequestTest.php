<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\TestCase;

class CreateCardRequestTest extends TestCase
{
    /**
     * @var CreditCard
     */
    private $card;

    public function setUp()
    {
        $this->card = $this->getValidCard();
        $this->request = new CreateCardRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setCustomerId('Y73MNPGJ18Y18V5KQODX');
        $this->request->setDefault(true);
        $this->request->setCard($this->card);
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/cards',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setProduction(false);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/cards',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testData()
    {
        $card = $this->card;
        $data = $this->request->getData();
        $this->assertSame('Y73MNPGJ18Y18V5KQODX', $data['customer_id']);
        $this->assertSame(true, $data['default']);
        $this->assertSame($card['firstName'] . ' ' . $card['lastName'], $data['name']);
        $this->assertSame($card['number'], $data['number']);
        $this->assertSame($card['expiryMonth'], $data['expiration_month']);
        $this->assertSame($card['expiryYear'], $data['expiration_year']);
        $this->assertSame($card['cvv'], $data['security_code']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateCardSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('E65OPXNV9D59WM7JL402', $response->getReference());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('CreateCardFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getReference());
        $this->assertNull($response->getData());
        $this->assertSame('Parâmetros inválidos.', $response->getMessage());
        $this->assertSame([
            'O cartão de crédito informado está vencido.',
        ], $response->getErrors());
    }
}
