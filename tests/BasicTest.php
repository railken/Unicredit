<?php

use PHPUnit\Framework\TestCase;
use Railken\Unicredit\Unicredit;
use duncan3dc\Laravel\Dusk;
use donatj\MockWebServer\MockWebServer;

class BasicTest extends TestCase
{
    public function getUnicredit($server_url)
    {
        return new Unicredit([
            'terminal_id' => 'UNI_ECOM',
            'api_key' => 'UNI_TESTKEY',
            'currency' => 'EUR',
            'lang' => 'IT',
            'base_url' => 'https://testuni.netsw.it',
            'verify_url' => $server_url . '/verify',
            'error_url' => $server_url . '/erroy'
        ]);
    }

    public function testCheckout()
    {
        $server = new MockWebServer;
        $server->start();

        $server_url = $server->getServerRoot();


        $uc = $this->getUnicredit($server_url);

        $order_id = md5(time());

        $response = $uc->payment($order_id, 'email@customer.com', 10);
        $transaction_id = $response->transaction_id;

        $this->assertEquals(20, strlen($transaction_id));


        $dusk = new Dusk;
        $dusk->visit($response->redirect_url);
        $dusk->waitFor('#continue');
        $dusk->waitFor('#PAN');
        $dusk->value('#ACCNTFIRSTNAME', 'Mario');
        $dusk->value('#ACCNTLASTNAME', 'Rossi');
        $dusk->value('input#PAN', '4242424242424242');
        $dusk->value('#EXPDT_MM', '01');
        $dusk->value('#EXPDT_YY', '32');
        $dusk->value('input#CVV', '333');

        $response = $dusk->click('#continue');

        // $response->getDriver()->takeScreenshot("test.png");

        $dusk->waitFor('#confirm');
        $dusk->click('#confirm');


        $dusk->pause(5000);

        $dusk->assertUrlIs($server_url . "/verify");

        $response = $uc->verify($order_id, $transaction_id);

        $this->assertEquals(true, $response->ok);
    }

}
