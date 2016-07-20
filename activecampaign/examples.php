<?php

	require_once("activecampaign/includes/ActiveCampaign.class.php");

	

function addsub()
	{

$first 	= $_POST['first'];
$last 	= $_POST['last'];
$email 	= $_POST['email'];

$ac = new ActiveCampaign("https://amytisweb.api-us1.com", "7cf075aac94b0b84aa38c0ea4b1c3e33aae49a7e2e6168208788c68d4f2fbc6805bb8a68");
		
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

		echo "<p>Syncing contact failed. Error returned: " . $contact_sync->error . "</p>";
		exit();
	}
        
        // successful request
        $contact_id = (int)$contact_sync->subscriber_id;
        session_start();
        $_SESSION['message'] = 'You have signed up';
        header('Location: php.php');
        echo "<p>Contact synced successfully (ID {$contact_id})!</p>";
	}

	


$Add = Addsub();

?>

