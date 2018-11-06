<?php

use PHPUnit\Framework\TestCase;
use Railken\Unicredit\Unicredit;
use duncan3dc\Laravel\Dusk;
use donatj\MockWebServer\MockWebServer;

class BasicTest extends TestCase
{   

    /**
     * @var MockWebServer
     */
    public $server;

    /**
     * Setup
     */
    public function setUp()
    {
        $this->server = new MockWebServer;
        $this->server->start();

        $this->unicredit = $this->getUnicredit();
    }

    /**
     * Retrieve server url
     *
     * @return string
     */
    public function getServerUrl()
    {
        return $this->server->getServerRoot();
    }

    /** 
     * Generate a new order id
     *
     * @return int
     */
    public function generateNewOrderId()
    {
        return md5(time());
    }

    /**
     * Create a new instance of Unicredit
     */
    public function getUnicredit()
    {
        return new Unicredit([
            'terminal_id' => 'UNI_ECOM',
            'api_key' => 'UNI_TESTKEY',
            'currency' => 'EUR',
            'lang' => 'IT',
            'base_url' => 'https://testuni.netsw.it',
            'verify_url' => $this->getServerUrl() . '/verify',
            'error_url' => $this->getServerUrl() . '/erroy'
        ]);
    }

    /**
     * Continue the action of payments 
     *
     * @param Dusk $dusk
     */
    public function continueToVerify(Dusk $dusk)
    {
        $dusk->waitFor('#continue');
        $dusk->waitFor('#PAN');
        $dusk->value('#ACCNTFIRSTNAME', 'Mario');
        $dusk->value('#ACCNTLASTNAME', 'Rossi');
        $dusk->value('input#PAN', '4242424242424242');
        $dusk->value('#EXPDT_MM', '01');
        $dusk->value('#EXPDT_YY', '32');
        $dusk->value('input#CVV', '333');

        $response = $dusk->click('#continue');

        $response->getDriver()->takeScreenshot("test.png");

        $dusk->waitFor('#confirm');
        $dusk->click('#confirm');

        $dusk->pause(5000);
    }

    public function testCheckout()
    {
        $order_id = $this->generateNewOrderId();

        $response = $this->unicredit->payment($order_id, 'email@customer.com', 10);
        $transaction_id = $response->transaction_id;
        $this->assertEquals(20, strlen($transaction_id));

        $dusk = new Dusk;
        $dusk->visit($response->redirect_url);
        $this->continueToVerify($dusk);
        $dusk->assertUrlIs($this->getServerUrl() . "/verify");

        $response = $this->unicredit->verify("wrong", $transaction_id);
        $this->assertEquals(false, $response->ok);
        $this->assertEquals(1, $response->error->code);
        $this->assertEquals("TRACK ID NON VALIDO ", $response->error->description);

        $response = $this->unicredit->verify($order_id, "wrong");
        $this->assertEquals(false, $response->ok);
        $this->assertEquals(1, $response->error->code);
        $this->assertEquals("CAMPO PAYMENT ID NON VALIDO", $response->error->description);

        $response = $this->unicredit->verify($order_id, $transaction_id);
        $this->assertEquals(true, $response->ok);
    }
}
