<?php

include ('init.php');
// user clicks the pay with paypal button
if (isset($_POST)) // checks that the post variable has been set (eg button pressed)
{
	// create Payment object
	include ('model/m_payments.php');
	include ('model/m_events.php');
	$Payments = new Payments(); // loads the payments methods
	$Order = new Posts(); // loads the create methods

if (!empty($_POST['location_id']))
{

	$cust_name = $_POST['name'];
	$cust_add = $_POST['address'];
	$cust_add_2 = $_POST['address2'];
	$town = $_POST['city'];
	$postcode = $_POST['postcode'];
	$cust_email = $_POST['email'];
	$cust_phone = $_POST['phone'];
	$item = $_POST['item'];
	$status = 'pending';
	$amount = $_POST['deposit'];

		$data = array();

		$data[] = array(
			'name' 			=> $item,
			'price'			=> $amount,
			'quantity'		=> 1);

	// get item data
	$paypal_item = $data; // gets the cart information

	$create_order = $Order->create_retreat_order($cust_name,$cust_add,$cust_add_2,$town,$postcode,$cust_email,$cust_phone,$item,$status,$amount);

	// get details
	$details['subtotal'] = $amount; // sets the subtotal info from cart info
	$details['shipping'] = 0; // sets the shipping to 0
	$details['shipping'] = number_format($details['shipping'], 2); // stores all required details information ready to send to payapl
	$details['total']	 = number_format($details['subtotal'] + $details['shipping'], 2);

	// send to paypal
	$error = $Payments->create_payment($paypal_item, $details);
	if($error != NULL)
	{
		$Template->set_alert($error, 'error'); // if an error reports and send back to cart page
		$Template->redirect('cart.php');
	}

}
else if(empty($_POST['retreat']))
{

		$data = array();

		$data[] = array(
			'name' 			=> $_POST['item'],
			'price'			=> $_POST['packagelength'],
			'quantity'		=> 1);

	// get item data
	$item = $data; // gets the cart information


	// get details
	$details['subtotal'] = $_POST['packagelength']; // sets the subtotal info from cart info
	$details['shipping'] = 0; // sets the shipping to 0
	$details['shipping'] = number_format($details['shipping'], 2); // stores all required details information ready to send to payapl
	$details['total']	 = number_format($details['subtotal'] + $details['shipping'], 2);

	// send to paypal
	$error = $Payments->create_payment($item, $details);
	if($error != NULL)
	{
		$Template->set_alert($error, 'error'); // if an error reports and send back to cart page
		$Template->redirect('cart.php');
	}
}
else
{
	$Template->redirect('contact.php');
}
}