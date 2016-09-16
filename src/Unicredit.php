<?php
	

namespace EchoWine\Unicredit;

use EchoWine\Unicredit\IGFS_CG_API\init\IgfsCgInit;

class Unicredit{


	/**
	 * Basic configuration
	 *
	 * @var array
	 */
	public static $cfg;

	/**
	 * Url to redirect in case of success
	 *
	 * @var string
	 */
	protected $success_url;
	
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
	public static function ini($cfg){
		self::$cfg = $cfg;
	}

	/**
	 * Get new instance request
	 *
	 * @return IgfsCgInit;
	 */
	public function getInit(){
		$init = new IgfsCgInit();
		$init -> serverURL = self::$cfg['url'];
		$init -> timeout = self::$cfg['timeout'];
		$init -> tid = self::$cfg['terminal_id'];
		$init -> kSig = self::$cfg['api_key'];
		$init -> currencyCode = self::$cfg['currency'];
		$init -> langID =  self::$cfg['lang'];

		return $init;
	}

	/**
	 * Set urls
	 *
	 * @param Array $urls
	 */
	public function urls($urls){
		$this -> success_url = $urls['success'];
		$this -> error_url = $urls['error'];
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
	public function payment($id,$email,$amount){

		$init = $this -> getInit();
		$init -> notifyURL = $this -> success_url;
		$init -> errorURL = $this -> error_url;
		$init -> shopID = $id;
		$init -> shopUserRef = $email;
		$init -> trType = "AUTH";
		$init -> amount = $amount * 100;

		$this -> init = $init;
		
		if(!$init -> execute()) 
			return false;
		
		return $init -> paymentID;
	}

	/** 
	 * Get the url to checkout
	 *
	 * @return string
	 */
	public function getUrl(){

		return $this -> init -> redirectURL;
	}

	/**
	 * Get Last error
	 *
	 * @return string
	 */
	public function getLastError(){
		return $this -> init -> errorDesc;
	}
}

?>