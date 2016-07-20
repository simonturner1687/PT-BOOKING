<?php

/*
	Payments  Class
	Handle all tasks related to payments
*/

require ('vendor/autoload.php');

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

class Payments
{
	private $api_context;

	function __construct() 
	{
		$this->api_context = $this->get_api_context();
	}

	/* 
		Getters and Setters
	*/


	public function get_api_context()
	{
		if (PAYPAL_MODE == 'sandbox')
		{
			$apiContext = new ApiContext(
				new OAuthTokenCredential(
					PAYPAL_DEVID,
					PAYPAL_DEVSECRET
				)
			);
		}
		else 
		{
			$apiContext = new ApiContext(
				new OAuthTokenCredential(
					PAYPAL_LIVEID,
					PAYPAL_LIVESECRET
				)
			);
		}

		$apiContext->setConfig(
			array(
				'mode' => PAYPAL_MODE,
				'http.ConnectionTimeOut' => 30,
				'log.LogEnabled' => true,
				'log.FileName' => 'PayPal.log',
				'log.LogLevel' => 'DEBUG',
				'cache.enabled' => true
			)
		);

		return $apiContext;
	}


	/**
	* Creates Paypal payment: step 2/3 
	*
	* @access public
	* @param 
	* @return error string
	*/
	public function create_payment($items_array, $details_array)
	{
		// ### Payer
		// A resource representing a Payer that funds a payment
		// For paypal account payments, set payment method
		// to 'paypal'.
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		// set items
		$i = 0;
		foreach($items_array as $item)
		{
			$items[$i] = new Item();
			$items[$i]
				->setName($item['name'])
      	  	    ->setCurrency(PAYPAL_CURRENCY)
      	 	    ->setQuantity($item['quantity'])
      		    ->setPrice($item['price']);
			$i++;
		}

		$itemList = new ItemList();
		$itemList->setItems($items);

		// ### Additional payment details
		// Use this optional field to set additional
		// payment information such as tax, shipping
		// charges etc.
		$details = new Details();
		$details
			//->setShipping($details_array['shipping']);
		    //->setTax($details_array['tax'])
		    ->setSubtotal($details_array['subtotal']);

		// ### Amount
		// Lets you specify a payment amount.
		// You can also specify additional details
		// such as shipping, tax.
		$amount = new Amount();
		$amount
			->setCurrency(PAYPAL_CURRENCY)
		    ->setTotal($details_array['total']);
		    //->setDetails($details);

		// ### Transaction
		// A transaction defines the contract of a
		// payment - what is the payment for and who
		// is fulfilling it. 
		$transaction = new Transaction();
		$transaction
				->setAmount($amount)
		    	->setItemList($itemList)
		    	->setDescription("Payment description");

		// ### Redirect urls
		// Set the urls that the buyer must be redirected to after 
		// payment approval/ cancellation.
		$redirectUrls = new RedirectUrls();
		$redirectUrls
				->setReturnUrl(SITE_PATH."success.php")
		    	->setCancelUrl(SITE_PATH."online.php");

		// ### Payment
		// A Payment Resource; create one using
		// the above types and intent set to 'sale'
		$payment = new Payment();
		$payment
				->setIntent("sale")
		    	->setPayer($payer)
		    	->setRedirectUrls($redirectUrls)
		    	->setTransactions(array($transaction));


		// For Sample Purposes Only.
		//$request = clone $payment;

		// ### Create Payment
		// Create a payment by calling the 'create' method
		// passing it a valid apiContext.
		// (See bootstrap.php for more on `ApiContext`)
		// The return object contains the state and the
		// url to which the buyer must be redirected to
		// for payment approval
		try {
			$payment->create($this->api_context);
		} catch (PayPal\Exception\PPConnectionException $ex) {
			return $ex->getMessage();
		}

		// get redirect url
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirectUrl = $link->getHref();
				break;
			}

		}
		//redirect
		$_SESSION['payment_id'] = $payment->getId();
		$payment_id = $_GET['paymentId'];
		if(isset($redirectUrl)) {
			header("Location: $redirectUrl");
			exit;
		}
		
	}

	/**
	* Execute Paypal payment: step 4/5 
	*
	* @access public
	* @param string string
	* @return result object
	*/
	public function execute_payment($payer_id, $payment_id)
	{
	    $payment = Payment::get($payment_id, $this->api_context);

	    $execution = new PaymentExecution();
	    $execution->setPayerId($payer_id);
	    $result = $payment->execute($execution, $this->api_context);

	    return $result;
	}






}


