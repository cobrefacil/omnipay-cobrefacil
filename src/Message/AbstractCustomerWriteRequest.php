<?php

namespace Omnipay\CobreFacil\Message;

abstract class AbstractCustomerWriteRequest extends AbstractRequest
{
    const PERSON_TYPE_PF = 1;
    const PERSON_TYPE_PJ = 2;

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $data['person_type'] = $this->getPersonType();
        switch ((int)$this->getPersonType()) {
            case self::PERSON_TYPE_PF:
                $data['taxpayer_id'] = $this->getTaxpayerId();
                $data['personal_name'] = $this->getPersonalName();
                break;
            case self::PERSON_TYPE_PJ:
                $data['ein'] = $this->getEin();
                $data['company_name'] = $this->getCompanyName();
                break;
        }
        if ($this->getTelephone()) {
            $data['telephone'] = $this->getTelephone();
        }
        if ($this->getCellular()) {
            $data['cellular'] = $this->getCellular();
        }
        if ($this->getEmail()) {
            $data['email'] = $this->getEmail();
        }
        if ($this->getEmailCC()) {
            $data['email_cc'] = $this->getEmailCC();
        }
        $data['address'] = [
            'description' => $this->getAddressDescription(),
            'zipcode' => $this->getAddressZipcode(),
            'street' => $this->getAddressStreet(),
            'number' => $this->getAddressNumber(),
            'neighborhood' => $this->getAddressNeighborhood(),
            'city' => $this->getAddressCity(),
            'state' => $this->getAddressState(),
        ];
        if ($this->getAddressComplement()) {
            $data['address']['complement'] = $this->getAddressComplement();
        }
        $nfse = [];
        if ($this->getNfseInscricaoEstadual()) {
            $nfse['inscricao_estadual'] = $this->getNfseInscricaoEstadual();
        }
        if ($this->getNfseResponsavelRetencao()) {
            $nfse['responsavel_retencao'] = $this->getNfseResponsavelRetencao();
        }
        if ($this->getNfseIssTipoTributacao()) {
            $nfse['iss']['tipo_tributacao'] = $this->getNfseIssTipoTributacao();
        }
        if ($this->getNfseIssExigibilidade()) {
            $nfse['iss']['exigibilidade'] = $this->getNfseIssExigibilidade();
        }
        if ($this->getNfseIssRetido()) {
            $nfse['iss']['retido'] = $this->getNfseIssRetido();
        }
        if ($this->getNfseIssProcessoSuspensao()) {
            $nfse['iss']['processo_suspensao'] = $this->getNfseIssProcessoSuspensao();
        }
        if (!empty($nfse)) {
            $data['nfse'] = $nfse;
        }
        return $data;
    }

    public function getPersonType()
    {
        return $this->getParameter('person_type');
    }

    public function setPersonType($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('person_type', $value);
    }

    public function getEin()
    {
        return $this->getParameter('ein');
    }

    public function setEin($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('ein', $value);
    }

    public function getCompanyName()
    {
        return $this->getParameter('company_name');
    }

    public function setCompanyName($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('company_name', $value);
    }

    public function getTaxpayerId()
    {
        return $this->getParameter('taxpayer_id');
    }

    public function setTaxpayerId($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('taxpayer_id', $value);
    }

    public function getPersonalName()
    {
        return $this->getParameter('personal_name');
    }

    public function setPersonalName($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('personal_name', $value);
    }

    public function getTelephone()
    {
        return $this->getParameter('telephone');
    }

    public function setTelephone($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('telephone', $value);
    }

    public function getCellular()
    {
        return $this->getParameter('cellular');
    }

    public function setCellular($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('cellular', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('email', $value);
    }

    public function getEmailCC()
    {
        return $this->getParameter('email_cc');
    }

    public function setEmailCC($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('email_cc', $value);
    }

    public function getAddressDescription()
    {
        return $this->getParameter('address.description');
    }

    public function setAddressDescription($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('address.description', $value);
    }

    public function getAddressZipcode()
    {
        return $this->getParameter('address.zipcode');
    }

    public function setAddressZipcode($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('address.zipcode', $value);
    }

    public function getAddressStreet()
    {
        return $this->getParameter('address.street');
    }

    public function setAddressStreet($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('address.street', $value);
    }

    public function getAddressNumber()
    {
        return $this->getParameter('address.number');
    }

    public function setAddressNumber($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('address.number', $value);
    }

    public function getAddressComplement()
    {
        return $this->getParameter('address.complement');
    }

    public function setAddressComplement($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('address.complement', $value);
    }

    public function getAddressNeighborhood()
    {
        return $this->getParameter('address.neighborhood');
    }

    public function setAddressNeighborhood($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('address.neighborhood', $value);
    }

    public function getAddressCity()
    {
        return $this->getParameter('address.city');
    }

    public function setAddressCity($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('address.city', $value);
    }

    public function getAddressState()
    {
        return $this->getParameter('address.state');
    }

    public function setAddressState($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('address.state', $value);
    }

    public function getNfseInscricaoEstadual()
    {
        return $this->getParameter('nfse.inscricao_estadual');
    }

    public function setNfseInscricaoEstadual($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('nfse.inscricao_estadual', $value);
    }

    public function getNfseResponsavelRetencao()
    {
        return $this->getParameter('nfse.responsavel_retencao');
    }

    public function setNfseResponsavelRetencao($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('nfse.responsavel_retencao', $value);
    }

    public function getNfseIssTipoTributacao()
    {
        return $this->getParameter('nfse.iss.tipo_tributacao');
    }

    public function setNfseIssTipoTributacao($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('nfse.iss.tipo_tributacao', $value);
    }

    public function getNfseIssExigibilidade()
    {
        return $this->getParameter('nfse.iss.exigibilidade');
    }

    public function setNfseIssExigibilidade($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('nfse.iss.exigibilidade', $value);
    }

    public function getNfseIssRetido()
    {
        return $this->getParameter('nfse.iss.retido');
    }

    public function setNfseIssRetido($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('nfse.iss.retido', $value);
    }

    public function getNfseIssProcessoSuspensao()
    {
        return $this->getParameter('nfse.iss.processo_suspensao');
    }

    public function setNfseIssProcessoSuspensao($value): AbstractCustomerWriteRequest
    {
        return $this->setParameter('nfse.iss.processo_suspensao', $value);
    }
}
