<?php

namespace Railken\Unicredit;

use Railken\Unicredit\IGFS_CG_API\init\IgfsCgInit;
use Railken\Unicredit\IGFS_CG_API\init\IgfsCgVerify;
use Railken\Bag;

class Unicredit
{

    /**
     * Basic configuration
     *
     * @var array
     */
    public $cfg;
    /**
     * Initialize the configuration
     *
     * @param array $cfg
     */
    public function __construct($cfg)
    {
        $this->cfg = array_merge([
            'timeout' => 150000
        ], $cfg);
    }

    /**
     * Get new instance request
     *
     * @return IgfsCgInit;
     */
    public function getInit()
    {
        $init = new IgfsCgInit();
        return $this->getCG($init);
    }

    /**
     * Get new instance request
     *
     * @return IgfsCgInit;
     */
    public function getVerify()
    {
        $verify = new IgfsCgVerify();
        return $this->getCG($verify);
    }

    public function getCG($obj)
    {
        $obj->timeout = $this->cfg['timeout'];
        $obj->tid = $this->cfg['terminal_id'];
        $obj->kSig = $this->cfg['api_key'];
        $obj->currencyCode = $this->cfg['currency'];
        $obj->langID =  $this->cfg['lang'];
        return $obj;
    }
    /**
     * Make request payment
     *
     * @param mixed $id order
     * @param string $email customer
     * @param float $amount to charge
     *
     * @return mixed payment ID
     */
    public function payment($id, $email, $amount)
    {
        $init = $this->getInit();
        $init->serverURL = $this->cfg['base_url']."/UNI_CG_SERVICES/services/PaymentInitGatewayPort?wsdl";
        $init->notifyURL = $this->cfg['verify_url'];
        $init->errorURL = $this->cfg['error_url'];
        $init->shopID = $id;
        $init->shopUserRef = $email;
        $init->trType = "AUTH";
        $init->amount = $amount * 100;

        $response = new Bag();


        if (!$init->execute()) {
            $response->error = $init->errorDesc;
            return false;
        }
        
        $response->transaction_id = $init->paymentID;
        $response->redirect_url = $init->redirectURL;

        return $response;
    }

    /**
     * Verify if a payments was made
     *
     * @param string $transaction
     * @param string $order
     *
     * @return bool
     */
    public function verify($order, $transaction)
    {
        $verify = $this->getVerify();
        $verify->serverURL = $this->cfg['base_url']."/UNI_CG_SERVICES/services";
        $verify->shopID = $order;
        $verify->paymentID = $transaction;
        $verify->execute();

        $response = new Bag();


        if ($verify->error) {
            $response->error = new Bag();
            $response->error->code = $verify->error;
            $response->error->description = $verify->errorDesc;
            return $response;
        }

        return $response;
    }
}
