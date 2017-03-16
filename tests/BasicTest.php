<?php

use PHPUnit\Framework\TestCase;
use EchoWine\Unicredit\Unicredit;

class BasicTest extends TestCase
{
   
    public function testCheckout()
    {

        # Initialize with configuration
        Unicredit::ini([
            'terminal_id' => 'UNI_ECOM',
            'api_key' => 'UNI_TESTKEY',
            'currency' => 'EUR',
            'lang' => 'IT'
        ]);

        $uc = new Unicredit();

        $uc->urls([
            'verify' => 'http://localhost/verify.php',
            'error' => 'http://localhost/error.php'
        ]);

        $order_id = md5(time());

        $transaction_id = $uc->payment($order_id,'email@customer.com',10);

        if ($transaction_id) {

            echo $uc->getUrl();
        
        }
    }
}