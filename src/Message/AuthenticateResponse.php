<?php

namespace Omnipay\CobreFacil\Message;

class AuthenticateResponse extends Response
{
    public function getToken(): string
    {
        return $this->data['data']['token'];
    }

    public function getExpiration(): int
    {
        return $this->data['data']['expiration'];
    }
}
