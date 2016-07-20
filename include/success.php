<?php

include ('init.php');

// create Payment object
include ('model/m_payments.php');
include ('model/m_events.php');
$Payments = new Payments();
$Posts = new Posts(); // loads the payments methods

// execute payment to finalise
$payer_id = htmlspecialchars($_GET['PayerID']);
$payment_id = $_SESSION['payment_id'];
$results = $Payments->execute_payment($payer_id, $payment_id);
$obj = json_decode($results);


      $Template->set_data('name', $results->payer->payer_info->first_name. ' ' .$results->payer->payer_info->last_name);

      $name = $results->payer->payer_info->first_name. ' ' .$results->payer->payer_info->last_name;
      $email_address = $results->payer->payer_info->email;
      $address = $results->payer->payer_info->recipient_name."\n";
      $address .= $results->payer->payer_info->billing_address->line1."\n";
      $address .= $results->payer->payer_info->billing_address->city."\n";
      $address .= $results->payer->payer_info->billing_address->state."\n";
      $address .= $results->payer->payer_info->billing_address->postal_code."\n";
      $address .= $results->payer->payer_info->billing_address->country_code."\n";
      $phone    = $results->payer->payer_info->phone."\n";
      $date = gmdate("d/m/y");

      $items = $obj->transactions[0]->item_list->items;
      $dbitems = '';
      $email_item_name = '';
      $email_item_price = '';

      foreach ($items as $item)
      {
            
            $dbitems .= $item->name;
            $dbitems .= " x";
            $dbitems .= $item->quantity;
            $dbitems .= "\n";
            $email_item_name .= $item->name;
            $email_item_price .= "&pound;";
            $email_item_price .= $item->price."<br />";
      }

      $email_total = $obj->transactions[0]->amount->total;

      //create DB conection
            $server   = '#';
            $user     = '#';
            $pass     = '#';
            $db       = '#';
      $Database = new mysqli($server, $user, $pass, $db); 


      $haystack = $email_item_name;
      $needle = 'Deposit';
      $confirmed = 'Confirmed';

      if (strpos($haystack,$needle) !== false) 
      {

      // create retreat Order
      $update = $Posts->update_retreat_order();

      }
      else
      {

      // create DB Order
      $create = $Posts->create_training_order($name, $address, $email_address, $phone, $dbitems, $date);

      }


      // Create the ORDERS email and send the message
      $to = '#'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
      $email_subject = "Scott Jose Order: $email_item_name";
      $email_body = "A new order has come through from $name. \n Email: $email_address \n Phone: $phone \n"."Here are the details:\n".$dbitems."\n"."They would like it delivered to:\n".$address."\n";
      $headers = "From: #\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
      $headers .= "Reply-To: $email_address"; 
      mail($to,$email_subject,$email_body,$headers);

      //create email reciept 
      include 'receipt1.php';
      send_receipt($email_item_name, $email_item_price, $email_total, $email_address, $name);


$Template->Redirect('confirmation.php'); 