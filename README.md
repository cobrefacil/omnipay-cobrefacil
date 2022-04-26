# Omnipay: Cobre Fácil

**Cobre Fácil driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment processing library for
PHP. This package implements Cobre Fácil support for Omnipay.

### Simple Example

```php
$gateway = \Omnipay\Omnipay::create('CobreFacil');
$gateway->setAppId('your_valid_app_id');
$gateway->setSecret('your_valid_secret');
$gateway->setTestMode(false);

try {
    $response = $gateway->purchase([
        'reference' => '123456',
        'payable_with' => 'credit',
        'customer_id' => 'Y73MNPGJ18Y18V5KQODX',
        'capture' => true,
        'card' => [
            'number' => '5555555555554444',
            'expiryMonth' => '12',
            'expiryYear' => '2022',
            'cvv' => '123'
        ],
        'items' => [
            [
                'description' => 'Name of product or service',
                'quantity' => 1,
                'price' => '19.99',
            ],
        ],  
    ])->send();
    
    if ($response->isSuccessful()) {
        echo 'Transaction id: ' . $response->getTransactionId() . PHP_EOL;
        echo 'Transaction reference: ' . $response->getTransactionReference() . PHP_EOL;
    }
} catch (\Exception $e) {
    // ...
}
```
