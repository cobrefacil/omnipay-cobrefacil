<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Tests\TestCase;

class CreateCustomerRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest());
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
        $this->request->setTestMode(true);
        $this->assertSame(
            'https://api.sandbox.cobrefacil.com.br/v1/customers',
            $this->request->getEndpoint()
        );
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testDataPF()
    {
        $this->request
            ->setPersonType(AbstractCustomerWriteRequest::PERSON_TYPE_PF)
            ->setTaxpayerId('123456789')
            ->setPersonalName('New Customer')
            ->setEin('123456789')
            ->setCompanyName('New Customer')
            ->setTelephone('11888887777')
            ->setCellular('11999998888')
            ->setEmail('customer@mail.com')
            ->setEmailCC('another_customer@mail.com')
            ->setAddressDescription('New Address')
            ->setAddressZipcode('88800000')
            ->setAddressStreet('Street')
            ->setAddressNumber('123')
            ->setAddressComplement('Complement')
            ->setAddressNeighborhood('Centro')
            ->setAddressCity('São Paulo')
            ->setAddressState('SP')
            ->setNfseInscricaoEstadual('98765')
            ->setNfseResponsavelRetencao('1')
            ->setNfseIssTipoTributacao('8')
            ->setNfseIssExigibilidade('7')
            ->setNfseIssRetido(true)
            ->setNfseIssProcessoSuspensao('4321');
        $data = $this->request->getData();
        $this->assertSame('123456789', $data['taxpayer_id']);
        $this->assertSame('New Customer', $data['personal_name']);
        $this->assertEmpty($data['ein']);
        $this->assertEmpty($data['company_name']);
        $this->assertSame('11888887777', $data['telephone']);
        $this->assertSame('11999998888', $data['cellular']);
        $this->assertSame('customer@mail.com', $data['email']);
        $this->assertSame('another_customer@mail.com', $data['email_cc']);
        $this->assertSame('New Address', $data['address']['description']);
        $this->assertSame('Street', $data['address']['street']);
        $this->assertSame('123', $data['address']['number']);
        $this->assertSame('Complement', $data['address']['complement']);
        $this->assertSame('Centro', $data['address']['neighborhood']);
        $this->assertSame('São Paulo', $data['address']['city']);
        $this->assertSame('SP', $data['address']['state']);
        $this->assertSame('1', $data['nfse']['responsavel_retencao']);
        $this->assertSame('8', $data['nfse']['iss']['tipo_tributacao']);
        $this->assertSame(true, $data['nfse']['iss']['retido']);
        $this->assertSame('4321', $data['nfse']['iss']['processo_suspensao']);
    }

    public function testDataPJUsingSetters()
    {
        $this->request
            ->setPersonType(AbstractCustomerWriteRequest::PERSON_TYPE_PJ)
            ->setTaxpayerId('123456789')
            ->setPersonalName('New Company')
            ->setEin('123456789')
            ->setCompanyName('New Company')
            ->setTelephone('11888887777')
            ->setCellular('11999998888')
            ->setEmail('customer@mail.com')
            ->setEmailCC('another_customer@mail.com')
            ->setAddressDescription('New Address')
            ->setAddressZipcode('88800000')
            ->setAddressStreet('Street')
            ->setAddressNumber('123')
            ->setAddressComplement('Complement')
            ->setAddressNeighborhood('Centro')
            ->setAddressCity('São Paulo')
            ->setAddressState('SP')
            ->setNfseInscricaoEstadual('98765')
            ->setNfseResponsavelRetencao('1')
            ->setNfseIssTipoTributacao('8')
            ->setNfseIssExigibilidade('7')
            ->setNfseIssRetido(true)
            ->setNfseIssProcessoSuspensao('4321');
        $data = $this->request->getData();
        $this->assertEmpty($data['taxpayer_id']);
        $this->assertEmpty($data['personal_name']);
        $this->assertSame('123456789', $data['ein']);
        $this->assertSame('New Company', $data['company_name']);
        $this->assertSame('11888887777', $data['telephone']);
        $this->assertSame('11999998888', $data['cellular']);
        $this->assertSame('customer@mail.com', $data['email']);
        $this->assertSame('another_customer@mail.com', $data['email_cc']);
        $this->assertSame('New Address', $data['address']['description']);
        $this->assertSame('Street', $data['address']['street']);
        $this->assertSame('123', $data['address']['number']);
        $this->assertSame('Complement', $data['address']['complement']);
        $this->assertSame('Centro', $data['address']['neighborhood']);
        $this->assertSame('São Paulo', $data['address']['city']);
        $this->assertSame('SP', $data['address']['state']);
        $this->assertSame('1', $data['nfse']['responsavel_retencao']);
        $this->assertSame('8', $data['nfse']['iss']['tipo_tributacao']);
        $this->assertSame(true, $data['nfse']['iss']['retido']);
        $this->assertSame('4321', $data['nfse']['iss']['processo_suspensao']);
    }

    public function testDataPJUsingArray()
    {
        $this->request->initialize([
            'person_type' => AbstractCustomerWriteRequest::PERSON_TYPE_PJ,
            'taxpayer_id' => '123456789',
            'personal_name' => 'New Company',
            'ein' => '123456789',
            'company_name' => 'New Company',
            'telephone' => '11888887777',
            'cellular' => '11999998888',
            'email' => 'customer@mail.com',
            'email_cc' => 'another_customer@mail.com',
            'address' => [
                'description' => 'New Address',
                'street' => 'Street',
                'number' => '123',
                'complement' => 'Complement',
                'neighborhood' => 'Centro',
                'city' => 'São Paulo',
                'state' => 'SP',
            ],
            'nfse' => [
                'responsavel_retencao' => '1',
                'iss' => [
                    'tipo_tributacao' => '8',
                    'retido' => true,
                    'processo_suspensao' => '4321',
                ],
            ],
        ]);
        $data = $this->request->getData();
        $this->assertEmpty($data['taxpayer_id']);
        $this->assertEmpty($data['personal_name']);
        $this->assertSame('123456789', $data['ein']);
        $this->assertSame('New Company', $data['company_name']);
        $this->assertSame('11888887777', $data['telephone']);
        $this->assertSame('11999998888', $data['cellular']);
        $this->assertSame('customer@mail.com', $data['email']);
        $this->assertSame('another_customer@mail.com', $data['email_cc']);
        $this->assertSame('New Address', $data['address']['description']);
        $this->assertSame('Street', $data['address']['street']);
        $this->assertSame('123', $data['address']['number']);
        $this->assertSame('Complement', $data['address']['complement']);
        $this->assertSame('Centro', $data['address']['neighborhood']);
        $this->assertSame('São Paulo', $data['address']['city']);
        $this->assertSame('SP', $data['address']['state']);
        $this->assertSame('1', $data['nfse']['responsavel_retencao']);
        $this->assertSame('8', $data['nfse']['iss']['tipo_tributacao']);
        $this->assertSame(true, $data['nfse']['iss']['retido']);
        $this->assertSame('4321', $data['nfse']['iss']['processo_suspensao']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateCustomerSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Y73MNPGJ18Y18V5KQODX', $response->getId());
        $this->assertNotNull($response->getData());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('CreateCustomerFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getId());
        $this->assertNull($response->getData());
        $this->assertSame('Parâmetros inválidos.', $response->getMessage());
        $this->assertSame([
            'O campo personal name é obrigatório.',
            'O campo taxpayer id é obrigatório.',
        ], $response->getErrors());
    }
}
