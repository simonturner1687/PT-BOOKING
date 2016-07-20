<?php

/*
	INIT
	Basic configuration settings
*/

// connect to the db
            $server   = '';
            $user     = '';
            $pass     = '';
            $db       = '';
$Database = new mysqli($server, $user, $pass, $db);


// setup constants
define('SITE_NAME', 'My Online Store');
define('SITE_PATH', '');


define('SHOP_TAX', '0.00');
define('PAYPAL_MODE', 'sandbox'); // either sandbox or live
define('PAYPAL_CURRENCY', 'GBP'); 
define('PAYPAL_DEVID', '');
define('PAYPAL_DEVSECRET', '');
define('PAYPAL_LIVEID', '');
define('PAYPAL_LIVESECRET', '');  



// include objects
include('model/m_template.php');
include('model/m_cart.php');


//create objects
$Template 	= new Template();
$Cart = new Cart();

session_start();
?>