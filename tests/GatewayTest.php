<?php

namespace Omnipay\CobreFacil;

use Omnipay\CobreFacil\Exception\InvalidCredentialsException;
use Omnipay\Omnipay;
use Omnipay\Tests\TestCase;

class GatewayTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testThrownAnExceptionWhenTheCredentialsAreInvalid($testMode)
    {
        $this->expectException(InvalidCredentialsException::class);
        $this->expectExceptionMessage('Credenciais inválidas.');
        /** @var Gateway $gateway */
        $gateway = Omnipay::create('CobreFacil');
        $gateway->setTestMode($testMode);
        $gateway->setAppId('invalid');
        $gateway->setSecret('invalid');
        $gateway->listCustomers()->send();
    }

    public function dataProvider()
    {
        return [
            'production' => [false],
            'sandbox' => [true],
        ];
    }
}
