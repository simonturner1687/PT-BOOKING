<?php  include('MailChimp.php'); 

$email_address = $_POST['email_address'];
$FNAME = $_POST['FNAME'];
$LNAME = $_POST['LNAME'];
$TOPIC = $_POST['TOPIC'];

   use \DrewM\MailChimp\MailChimp;

$MailChimp = new MailChimp('');

$list_id = '';

$result = $MailChimp->post("lists/$list_id/members", [
                'email_address' => '$email_address',
                'merge_fields' => ['FNAME'=>'$FNAME', 'LNAME'=>'$LNAME', 'TOPIC'=>'$TOPIC'],
                'status'        => 'subscribed',
            ]);

if ($MailChimp->success()) {
    print_r($result);   
} else {
    echo $MailChimp->getLastError();
}

?>