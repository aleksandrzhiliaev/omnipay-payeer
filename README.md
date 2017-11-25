# omnipay-payeer
[![Build Status](https://travis-ci.org/aleksandrzhiliaev/omnipay-payeer.svg?branch=master)](https://travis-ci.org/aleksandrzhiliaev/omnipay-payeer)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/55a566d55cbd4192b6a49cd753c39dde)](https://www.codacy.com/app/sassoftinc/omnipay-payeer?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=aleksandrzhiliaev/omnipay-payeer&amp;utm_campaign=Badge_Grade)
[![Total Downloads](https://poser.pugx.org/aleksandrzhiliaev/omnipay-payeer/downloads)](https://packagist.org/packages/aleksandrzhiliaev/omnipay-payeer)

Payeer gateway for [Omnipay](https://github.com/thephpleague/omnipay) payment processing library.

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Advcash support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "aleksandrzhiliaev/omnipay-payeer": "*"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Payeer

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

## Example
1. Purchase:
```php
$gateway = Omnipay::create('Payeer');

$gateway->setAccount('P...');
$gateway->setShopId('');
$gateway->setShopSecret('');
$gateway->setCurrency('USD');

$gateway->setApiId('');
$gateway->setApiSecret('');


$response = $gateway->purchase([
       'amount' => '0.1',
       'currency' => 'USD',
       'transactionId' => time(),
       'description' => 'Order # 123',
       'cancelUrl' => 'https://example.com',
       'returnUrl' => 'https://example.com',
       'notifyUrl' => 'https://example.com'
        ])->send();

if ($response->isSuccessful()) {
   // success
} elseif ($response->isRedirect()) {

   # Generate form to do payment
   $hiddenFields = '';
   foreach ($response->getRedirectData() as $key => $value) {
       $hiddenFields .= sprintf(
          '<input type="hidden" name="%1$s" value="%2$s" />',
           htmlentities($key, ENT_QUOTES, 'UTF-8', false),
           htmlentities($value, ENT_QUOTES, 'UTF-8', false)
          )."\n";
   }

   $output = '<form action="%1$s" method="post"> %2$s <input type="submit" value="Purchase" /></form>';
   $output = sprintf(
      $output,
      htmlentities($response->getRedirectUrl(), ENT_QUOTES, 'UTF-8', false),
      $hiddenFields
   );
   echo $output;
   # End of generating form
} else {
   echo $response->getMessage();
}
```
2. Validate webhook
```php
try {
    $response = $gateway->completePurchase()->send();
    $transactionId = $response->getTransactionId();
    $amount = $response->getAmount();
    $success = $response->isSuccessful();
    $currency = $response->getCurrency();
    if ($success) {
       // success 
    }
} catch (\Exception $e) {
  // check $e->getMessage()
}
```
3. Do refund
```php
try {
    $response = $gateway->refund(
        [
            'payeeAccount' => '',
            'amount' => 0.1,
            'description' => 'Testing payeer',
            'currency' => 'USD',
        ]
    )->send();

    if ($response->isSuccessful()) {
        // success  
    } else {
        // check $response->getMessage();
    }

} catch (\Exception $e) {
    // check $e->getMessage();
}
```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/aleksandrzhiliaev/omnipay-nixmoney/issues).
