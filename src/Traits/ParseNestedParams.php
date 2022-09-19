<?php

namespace Omnipay\CobreFacil\Traits;

use Omnipay\Common\Helper;

trait ParseNestedParams
{
    public function parseNestedParams(array $parameters): void
    {
        foreach ($parameters as $key1 => $value1) {
            if (is_array($value1)) {
                foreach ($value1 as $key2 => $value2) {
                    if (is_array($value2)) {
                        foreach ($value2 as $key3 => $value3) {
                            $method = 'set' . $this->parseKey($key1) . $this->parseKey($key2) . $this->parseKey($key3);
                            $this->$method($value3);
                        }
                    } else {
                        $method = 'set' . $this->parseKey($key1) . $this->parseKey($key2);
                        $this->$method($value2);
                    }
                }
            }
        }
    }

    public function parseKey(string $key): string
    {
        return ucfirst(Helper::camelCase($key));
    }
}
