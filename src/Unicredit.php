<?php
	
namespace EchoWine\Unicredit;

use EchoWine\Unicredit\IGFS_CG_API\init\IgfsCgInit;
use EchoWine\Unicredit\IGFS_CG_API\init\IgfsCgVerify;
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
	 * Server url
	 *
	 * @var string
	 */
	private $server_url = "https://testuni.netsw.it/UNI_CG_SERVICES/services/PaymentInitGatewayPort?wsdl";
	
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
	public function __construct($cfg)
	{
		$this->cfg = array_merge([
			'timeout' => 3600
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
		$init->serverURL = $this->server_url;
		$init->notifyURL = $this->verify_url;
		$init->errorURL = $this->error_url;
		$init->shopID = $id;
		$init->shopUserRef = $email;
		$init->trType = "AUTH";
		$init->amount = $amount * 100;

		if(!$init->execute()) 
			return false;
		
		$response = new Bag();
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
		$verify->serverURL = "https://testuni.netsw.it/UNI_CG_SERVICES/services";
		$verify->shopID = $order;
		$verify->paymentID = $transaction;
		$verify->execute();

		$response = new Bag();

		return $response;
	}
}