<?php

use PHPUnit\Framework\TestCase;
use EchoWine\Unicredit\Unicredit;

class BasicTest extends TestCase
{
   
    public function getUnicredit()
    {
         return new Unicredit([
            'terminal_id' => 'UNI_ECOM',
            'api_key' => 'UNI_TESTKEY',
            'currency' => 'EUR',
            'lang' => 'IT',
            'base_url' => 'https://testuni.netsw.it',
            'verify_url' => 'http://localhost/verify.php',
            'error_url' => 'http://localhost/error.php'
        ]);
    }

    public function testCheckout()
    {

        $uc = $this->getUnicredit();

        $order_id = md5(time());

        $response = $uc->payment($order_id, 'email@customer.com', 10);
        $this->assertEquals(20, strlen($response->transaction_id));
        print_r("\n-------------------------\n");
        print_r(sprintf("\nCheckout: %s", $response->redirect_url));
        print_r(sprintf("\nOrder ID: %s\nTransaction ID: %s", $order_id, $response->transaction_id));


        $response = $uc->verify($order_id, $response->transaction_id);

        $this->assertEquals("TRANSAZIONE IN CORSO", $response->error->description);
    }


    public function testVerify()
    {

        $uc = $this->getUnicredit();

        $order_id = md5(time());

        $response = $uc->payment($order_id, 'email@customer.com', 10);
        $this->assertEquals(20, strlen($response->transaction_id));
        print_r("\n-------------------------\n");
        print_r(sprintf("\nCheckout: %s", $response->redirect_url));
        print_r(sprintf("\nOrder ID: %s\nTransaction ID: %s", $order_id, $response->transaction_id));
    }
}