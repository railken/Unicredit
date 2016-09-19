# Unicredit
Library to perform online payments with unicredit

# Links
[Unicredit Backoffice](https://testeps.netswgroup.it/UNI_CG_BO_WEB/app/login/show)

User: UNIBO

Password: UniBo2014

[Unicredit Documentation](https://testeps.netswgroup.it/UNI_CG_BRANDING/UNI/doc/api_manual.pdf)

[Unicredit Assistance](https://trasparenza.unicredit.it/pdfprod/GP49-PAGAMENTI-ELETTRONICI--SERVIZIO-PAGONLINE-CARTE_IT.pdf)


# Installation
```
$ composer require echowine/unicredit
```

# Basic configuration

```php
<?php

use EchoWine\Unicredit\Unicredit;

# Initialize with configuration
Unicredit::ini([
    'terminal_id' => 'UNI_ECOM',
    'api_key' => 'UNI_TESTKEY',
    'currency' => 'EUR',
    'lang' => 'IT'
]);
```


# Checkout page

```php
<?php

use EchoWine\Unicredit\Unicredit;

# Make a new instance
$uc = new Unicredit();

# Set redirect url
$uc -> urls([
    'verify' => 'http://localhost/verify.php',
    'error' => 'http://localhost/error.php'
]);

# Create a random ID for an order
$order_id = md5(time());

# Make a request
# Return the Payment ID
$transaction_id = $uc -> payment($order_id,'email@customer.com',10);

if($transaction_id){
    
    # IMPORTANT !!!    
    # Save $order_id and $transaction_id in DB or Cookie in order to retrieve in the next page

    # Redirect to the checkout
    $uc -> getUrl();

}else{
	
    # Get error
    $error = $uc -> getLastError();
}

```


# Verify page

```php
<?php

use EchoWine\Unicredit\Unicredit;

# Retrieve $transaction_id and $order_id from DB/Cookie

# Make a new instance
$uc = new Unicredit();

$check = $uc -> verify($order_id,$transaction_id);

if($check){

    $response = $uc -> getResponse();

    if(empty($response -> error)){

        # Success!!!
        # Payments is now confirmed

    }else{

        # Some error
        $uc -> getLastError();
    }


}else{
    
    # Error: check failed
    $uc -> getLastError();
}


```
