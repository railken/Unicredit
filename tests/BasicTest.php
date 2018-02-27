<?php

use PHPUnit\Framework\TestCase;
use EchoWine\Unicredit\Unicredit;

class BasicTest extends TestCase
{
   
    public function testCheckout()
    {

        $uc = new Unicredit([
            'terminal_id' => 'UNI_ECOM',
            'api_key' => 'UNI_TESTKEY',
            'currency' => 'EUR',
            'lang' => 'IT'
        ]);

        $uc->urls([
            'verify' => 'http://localhost/verify.php',
            'error' => 'http://localhost/error.php'
        ]);

        $order_id = md5(time());

        $response = $uc->payment($order_id,'email@customer.com',10);
        $this->assertEquals(20, strlen($response->transaction_id));
    }
}