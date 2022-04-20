<?php

namespace Omnipay\CobreFacil\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @inheritDoc
     */
    public function __construct(RequestInterface $request, $data)
    {
        $data = json_decode($data, true);
        parent::__construct($request, $data);
    }

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return isset($this->data['success']) && true === $this->data['success'];
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return parent::getData()['data'];
    }

    /**
     * Returns if the request was successful.
     */
    public function getSuccess(): bool
    {
        if (isset($this->data['success'])) {
            return $this->data['success'];
        }
        return false;
    }

    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     */
    public function getMessage(): ?string
    {
        if (!$this->isSuccessful() && isset($this->data['message'])) {
            return $this->data['message'];
        }
        return null;
    }

    /**
     * Get the resource reference from the response.
     *
     * Returns null if the request was not successful.
     */
    public function getReference(): ?string
    {
        if (!$this->isSuccessful()) {
            return null;
        }
        return $this->getData()['id'];
    }
}
