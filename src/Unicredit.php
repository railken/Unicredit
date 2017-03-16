<?php
	
namespace EchoWine\Unicredit;

use EchoWine\Unicredit\IGFS_CG_API\init\IgfsCgInit;
use EchoWine\Unicredit\IGFS_CG_API\init\IgfsCgVerify;

class Unicredit
{

	/**
	 * Basic configuration
	 *
	 * @var array
	 */
	public static $cfg;
	
	/**
	 * Url to redirect in case of error
	 *
	 * @var string
	 */
	protected $verify_url;
	
	/**
	 * Url to redirect in case of error
	 *
	 * @var string
	 */
	protected $error_url;

	/**
	 * Initialize the configuration
	 *
	 * @param array $cfg
	 */
	public static function ini($cfg)
	{
		self::$cfg = $cfg;
		self::$cfg['timeout'] = 15000;
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
		$obj->timeout = self::$cfg['timeout'];
		$obj->tid = self::$cfg['terminal_id'];
		$obj->kSig = self::$cfg['api_key'];
		$obj->currencyCode = self::$cfg['currency'];
		$obj->langID =  self::$cfg['lang'];
		return $obj;
	}

	/**
	 * Set urls
	 *
	 * @param array $urls
	 */
	public function urls($urls)
	{
		$this->verify_url = isset($urls['verify']) ? $urls['verify'] : null;
		$this->error_url = isset($urls['error']) ? $urls['error'] : null;
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
		$init->serverURL = "https://testuni.netsw.it/UNI_CG_SERVICES/services/PaymentInitGatewayPort?wsdl";
		$init->notifyURL = $this->verify_url;
		$init->errorURL = $this->error_url;
		$init->shopID = $id;
		$init->shopUserRef = $email;
		$init->trType = "AUTH";
		$init->amount = $amount * 100;

		$this->response = $init;
		
		if(!$init->execute()) 
			return false;
		
		return $init->paymentID;
	}

	/**
	 * Get response
	 *
	 * @return Response
	 */
	public function getResponse()
	{
		return $this->response;
	}
	
	/** 
	 * Get the url to checkout
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return $this->response->redirectURL;
	}

	/**
	 * Get Last error
	 *
	 * @return string
	 */
	public function getLastError()
	{
		return $this->response->errorDesc;
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
		$verify->serverURL = "https://testuni.netsw.it/UNI_CG_SERVICES/services";
		$verify->shopID = $order;
		$verify->paymentID = $transaction;
		$this->response = $verify;

		return $verify->execute();
	}
}