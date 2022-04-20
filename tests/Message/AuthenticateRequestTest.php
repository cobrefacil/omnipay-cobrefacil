<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class AuthenticateRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new AuthenticateRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testEndpointProduction()
    {
        $this->assertSame('https://api.cobrefacil.com.br/v1/authenticate', $this->request->getEndpoint());
    }

    public function testEndpointSandbox()
    {
        $this->request->setProduction(false);
        $this->assertSame('https://api.sandbox.cobrefacil.com.br/v1/authenticate', $this->request->getEndpoint());
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('AuthenticateSuccess.txt');
        /** @var AuthenticateResponse $response */
        $response = $this->request->sendData([
            'app_id' => 'valid_app_id',
            'secret' => 'valid_secret',
        ]);
        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->getSuccess());
        $this->assertSame('fe6c142d9b12db87d4a174c45e8b0e69/1a57c40a92cb6fe7bee630d88b783844d565fbac2ebfe5bb0626349e64c1e5298d03548cb6f95daaacac9fe497dc3924cfbed28a655aa9bbdeff55b06e0ee410', $response->getToken());
        $this->assertSame(3600, $response->getExpiration());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('AuthenticateFailure.txt');
        $response = $this->request->sendData([
            'app_id' => 'invalid',
            'secret' => 'invalid',
        ]);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->getSuccess());
        $this->assertSame('Credenciais inválidas.', $response->getMessage());
    }
}
