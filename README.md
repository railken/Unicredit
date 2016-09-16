# unicredit
Unicredit library for online payments

```php
<?php

use EchoWine\Unicredit\Unicredit;

# Initialize config
Unicredit::ini([
    'url' => "https://testuni.netsw.it/UNI_CG_SERVICES/services/PaymentInitGatewayPort?wsdl",
    'timeout' => 15000,
    'terminal_id' => 'UNI_ECOM',
    'api_key' => 'UNI_TESTKEY',
    'currency' => 'EUR',
    'lang' => 'IT',
    'success_url' => 'http://localhost/payments/unicredit/success.php',
    'error_url' => 'http://localhost/payments/unicredit/error.php',
]);

$uc = new Unicredit();

$order_id = md5(time());
$id = $uc -> payment($order_id,'email@customer.com',10);

# PAYMENT ID;
echo $id;

# Redirect location to checkout
echo $uc -> getUrl();

?>
```
