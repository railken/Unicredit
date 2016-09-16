# unicredit
Unicredit library for online payments

```php
<?php

use EchoWine\Unicredit\Unicredit;

# Initialize with configuration
Unicredit::ini([
    'url' => "https://testuni.netsw.it/UNI_CG_SERVICES/services/PaymentInitGatewayPort?wsdl",
    'timeout' => 15000,
    'terminal_id' => 'UNI_ECOM',
    'api_key' => 'UNI_TESTKEY',
    'currency' => 'EUR',
    'lang' => 'IT'
]);

# Make a new instance
$uc = new Unicredit();

# Set redirect url
$uc -> urls([
    'success' => 'http://localhost/success.php',
    'error' => 'http://localhost/error.php'
]);

# Create a random ID for an order
$order_id = md5(time());

# Make a request
# Return the Payment ID
$id = $uc -> payment($order_id,'email@customer.com',10);

if($id){
    
    # Redirect to the checkout
    $uc -> getUrl();

}else{
	
	# Get error
    $error = $uc -> getLastError();
}

?>
```
