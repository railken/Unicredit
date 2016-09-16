<?php
	

namespace Unicredit\Api;

use Unicredit\Api\IGFS_CG_API\init\IgfsCgInit;

class Gateway{


	public static $cfg;

	public static function ini($cfg){
		self::$cfg = $cfg;
	}

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

	public function process($id,$email,$amount){

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

	public function go(){


		header("location: ".$this -> init -> redirectURL);

		return;
	}
}

?>