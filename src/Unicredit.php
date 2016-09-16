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
		$init -> notifyURL = $this -> getUrlDir()."/".self::$cfg['success_url'];
		$init -> errorURL = $this -> getUrlDir()."/".self::$cfg['error_url'];

		return $init;
	}

	public function getUrlDir(){
		return 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
	}

	public function payment($id,$email,$amount){

		$init = $this -> getInit();
		$init -> shopID = $id;
		$init -> shopUserRef = $email;
		$init -> trType = "AUTH";
		$init -> amount = $amount * 100;

		if(!$init -> execute()) 
			throw \Exception(urlencode($init -> errorDesc));
		
		$this -> init = $init;
		return $init -> paymentID;
	}

	public function getUrl(){

		return $this -> init -> redirectURL;
	}
}

?>