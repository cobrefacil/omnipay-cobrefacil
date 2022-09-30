<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Common\ItemBag;
use Omnipay\Tests\TestCase;
use Omnipay\CobreFacil\InvoiceSettings;
use Omnipay\CobreFacil\SubscriptionItem;

class UpdateSubscriptionRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new UpdateSubscriptionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setReference('GNX93QM18WQQ8KW6YVZO');
    }

    public function testEndpointProduction()
    {
        $this->assertSame(
            'https://api.cobrefacil.com.br/v1/subscriptions/GNX93QM18WQQ8KW6YVZO',
            $this->request->getEndpoint()
        );
    }

    public function testEndpointSandbox()
    {
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/subscriptions/GNX93QM18WQQ8KW6YVZO',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('PUT', $this->request->getHttpMethod());
    }

    public function testUpdateUsingInitialize()
    {
        $this->request->initialize([
            'next_expiration' => '2023-01-01',
            'expires_at' => '2023-04-01',
            'contract_number' => '123456',
            'payable_with' => 'credit',
            'customer_id' => 'N5YG0OV16ZED1EKX7M8Z',
            'generate_days' => 5,
            'interval_type' => 'month',
            'interval_size' => 1,
            'reference'=> 'none',
            'notification_rule_id' => '52XD4W3GE1DZ97JM1R0K',
            'items' => [
                    [
                        'products_services_id' => 'Y1LOJWXR9LX5926K8Q70',
                        'quantity' => 2,
                        'price'=> 7500
                    ]
            ],
            'settings' => [
                'late_fee' => [
                    'mode' => InvoiceSettings::LATE_FEE_MODE_FIXED,
                    'amount' => 1.99,
                ],
                'interest' => [
                    'mode' => InvoiceSettings::INTEREST_DAILY_PERCENTAGE,
                    'amount' => 2.99,
                ],
                'discount' => [
                    'mode' => InvoiceSettings::DISCOUNT_MODE_PERCENTAGE,
                    'amount' => 1.11,
                    'limit_date' => '2022-12-01',
                ],
                'warning' => [
                    'description' => 'Em caso de dúvidas entre em contato com nossa Central de Atendimento.',
                ],
                'send_tax_invoice' => true,
            ],
        ]);
        $data = $this->request->getData();
        $this->assertSame('2023-01-01', $data['next_expiration']);
        $this->assertSame('2023-04-01', $data['expires_at']);
        $this->assertSame('123456', $data['contract_number']);
        $this->assertSame('credit', $data['payable_with']);
        $this->assertSame('N5YG0OV16ZED1EKX7M8Z', $data['customer_id']);
        $this->assertSame(5, $data['generate_days']);
        $this->assertSame('month', $data['interval_type']);
        $this->assertSame(1, $data['interval_size']);
        $this->assertSame('none', $data['reference']);
        $this->assertSame('52XD4W3GE1DZ97JM1R0K', $data['notification_rule_id']);
        $this->assertSame('Y1LOJWXR9LX5926K8Q70', $data['items'][0]['products_services_id']);
        $this->assertSame(2, $data['items'][0]['quantity']);
        $this->assertSame(7500, $data['items'][0]['price']);
        $this->assertSame(InvoiceSettings::LATE_FEE_MODE_FIXED, $data['settings']['late_fee']['mode']);
        $this->assertSame(1.99, $data['settings']['late_fee']['amount']);
        $this->assertSame(InvoiceSettings::INTEREST_DAILY_PERCENTAGE, $data['settings']['interest']['mode']);
        $this->assertSame(2.99, $data['settings']['interest']['amount']);
        $this->assertSame(InvoiceSettings::DISCOUNT_MODE_PERCENTAGE, $data['settings']['discount']['mode']);
        $this->assertSame(1.11, $data['settings']['discount']['amount']);
        $this->assertSame('2022-12-01', $data['settings']['discount']['limit_date']);
        $this->assertSame('Em caso de dúvidas entre em contato com nossa Central de Atendimento.', $data['settings']['warning']['description']);
        $this->assertSame(true, $data['settings']['send_tax_invoice']);
    }

    public function testUpdateUsingSetters()
    {
        $item1 = (new SubscriptionItem())
            ->setProductsServicesId('Y1LOJWXR9LX5926K8Q70')
            ->setQuantity(2)
            ->setPrice(7500);
        $this->request->setNextExpiration('2023-01-01');
        $this->request->setExpiresAt('2023-04-01');
        $this->request->setContractNumber('123456');
        $this->request->setPayableWith('credit');
        $this->request->setCustomerId('N5YG0OV16ZED1EKX7M8Z');
        $this->request->setGenerateDays(5);
        $this->request->setIntervalType('month');
        $this->request->setIntervalSize(1);
        $this->request->setReferenceField('none');
        $this->request->setNotificationRuleId('52XD4W3GE1DZ97JM1R0K');
        $this->request->setItems(new ItemBag([$item1]));
        $this->request->setSettings(new InvoiceSettings([
            'late_fee' => [
                'mode' => InvoiceSettings::LATE_FEE_MODE_FIXED,
                'amount' => 1.99,
            ],
            'interest' => [
                'mode' => InvoiceSettings::INTEREST_DAILY_PERCENTAGE,
                'amount' => 2.99,
            ],
            'discount' => [
                'mode' => InvoiceSettings::DISCOUNT_MODE_PERCENTAGE,
                'amount' => 1.11,
                'limit_date' => '2022-12-01',
            ],
            'warning' => [
                'description' => 'Em caso de dúvidas entre em contato com nossa Central de Atendimento.',
            ],
            'send_tax_invoice' => true,
        ]));
        $data = $this->request->getData();
        $this->assertSame('2023-01-01', $data['next_expiration']);
        $this->assertSame('2023-04-01', $data['expires_at']);
        $this->assertSame('123456', $data['contract_number']);
        $this->assertSame('credit', $data['payable_with']);
        $this->assertSame('N5YG0OV16ZED1EKX7M8Z', $data['customer_id']);
        $this->assertSame(5, $data['generate_days']);
        $this->assertSame('month', $data['interval_type']);
        $this->assertSame(1, $data['interval_size']);
        $this->assertSame('none', $data['reference']);
        $this->assertSame('52XD4W3GE1DZ97JM1R0K', $data['notification_rule_id']);
        $this->assertSame('Y1LOJWXR9LX5926K8Q70', $data['items'][0]['products_services_id']);
        $this->assertSame(2, $data['items'][0]['quantity']);
        $this->assertSame(7500, $data['items'][0]['price']);
        $this->assertSame(InvoiceSettings::LATE_FEE_MODE_FIXED, $data['settings']['late_fee']['mode']);
        $this->assertSame(1.99, $data['settings']['late_fee']['amount']);
        $this->assertSame(InvoiceSettings::INTEREST_DAILY_PERCENTAGE, $data['settings']['interest']['mode']);
        $this->assertSame(2.99, $data['settings']['interest']['amount']);
        $this->assertSame(InvoiceSettings::DISCOUNT_MODE_PERCENTAGE, $data['settings']['discount']['mode']);
        $this->assertSame(1.11, $data['settings']['discount']['amount']);
        $this->assertSame('2022-12-01', $data['settings']['discount']['limit_date']);
        $this->assertSame('Em caso de dúvidas entre em contato com nossa Central de Atendimento.', $data['settings']['warning']['description']);
        $this->assertSame(true, $data['settings']['send_tax_invoice']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('UpdateSubscriptionSuccess.txt');
        /** @var TransactionResponse $response */
        $response = $this->request
            ->setPayableWith('credit')
            ->setNextExpiration(date('Y-m-d'))
            ->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame($response->getId(), 'GNX93QM18WQQ8KW6YVZO');
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('UpdateSubscriptionFailure.txt');
        /** @var TransactionResponse $response */
        $response = $this->request
            ->setPayableWith('credit')
            ->setNextExpiration(date('Y-m-d', strtotime('-1 day')))
            ->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getId());
        $this->assertNull($response->getData());
        $this->assertSame('Parâmetros inválidos.', $response->getMessage());
        $this->assertSame([
            'Next expiration deve ser uma data maior ou igual a today.',
        ], $response->getErrors());
    }
}
