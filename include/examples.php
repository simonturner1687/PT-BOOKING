<?php

	require_once("activecampaign/includes/ActiveCampaign.class.php");

	

function addsub()
	{

$first 	= $_POST['first'];
$last 	= $_POST['last'];
$email 	= $_POST['email'];

$ac = new ActiveCampaign("", "");
		
		if (!(int)$ac->credentials_test()) {
		echo "<p>Access denied: Invalid credentials (URL and/or API key).</p>";
		exit();
	}
		
		$contact = array(
		"email"              => $email,
		"first_name"         => $first,
		"last_name"          => $last,
		"p[1]"      => 1,
		"status" => 1, // "Active" status
	);


	$contact_sync = $ac->api("contact/sync", $contact);

	if (!(int)$contact_sync->success) {
		// request failed
        session_start();
        $_SESSION['message'] = 'Error returned:'. $contact_sync->error ;
        header('Location: blog.php');
        exit();
	}
        
        // successful request
        $contact_id = (int)$contact_sync->subscriber_id;
        session_start();
        $_SESSION['message'] = 'You have signed up';
        header('Location: blog.php');
	}

	


$Add = Addsub();

?>

