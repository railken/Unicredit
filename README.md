# Unicredit
A very very very simple library that performs online payments with unicredit.
This is more an example than an actual library.

# Links
[Unicredit Backoffice](https://testeps.netswgroup.it/UNI_CG_BO_WEB/app/login/show)

User: UNIBO

Password: UniBo2014

[Unicredit Documentation](https://testeps.netswgroup.it/UNI_CG_BRANDING/UNI/doc/api_manual.pdf)

[Unicredit Assistance](https://trasparenza.unicredit.it/pdfprod/GP49-PAGAMENTI-ELETTRONICI--SERVIZIO-PAGONLINE-CARTE_IT.pdf)

The original library can be found in the Backoffice under the following path:

```PROFILO ESERCENTE >> Documentazione e Supporto >> API Pack```


# Installation
```
$ composer require railken/unicredit
```

# Basic configuration

```php
<?php

use Railken\Unicredit\Unicredit;

$uc = new Unicredit([
    'terminal_id' => 'UNI_ECOM',
    'api_key' => 'UNI_TESTKEY',
    'currency' => 'EUR',
    'lang' => 'IT',
    'base_url' => 'https://testuni.netsw.it',
    'verify_url' => 'http://localhost/verify.php',
    'error_url' => 'http://localhost/error.php'
]);
```



# Checkout page

```php
<?php

use Railken\Unicredit\Unicredit;

# Make a new instance
$uc = new Unicredit();

# Create a random ID for an order
$order_id = md5(time());

# Make a payment for 10,00 EUR
# Return the Payment ID
$response = $uc->payment($order_id, 'email@customer.com', 10);

if (!$response->error) {
    
    # IMPORTANT !!!    
    # Save $order_id and $transaction_id in DB or Cookie in order to retrieve in the next page

    # Redirect to the checkout
    $response->redirect_url;

}else{
	
    # Get error
    $error = $response->error->message;
}

```


# Verify page

```php
<?php

use Railken\Unicredit\Unicredit;

# Retrieve $transaction_id and $order_id from DB/Cookie

# Make a new instance
$uc = new Unicredit();

$response = $uc->verify($order_id, $transaction_id);

if (!$response->error) {

    # Success

} else {
    # Get error
    $error = $response->error->message;
}


```
