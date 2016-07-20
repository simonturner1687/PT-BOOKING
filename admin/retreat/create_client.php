<?php

include 'model/m_events.php';

$cust_name = $_POST['name'];
$cust_add = $_POST['address'];
$cust_add_2 = $_POST['address2'];
$town = $_POST['town'];
$postcode = $_POST['postcode'];
$cust_email = $_POST['email'];
$cust_phone = $_POST['phone'];
$item = $_POST['location'];
$status = $_POST['status'];
$amount = $_POST['amount'];


    $Posts = new Posts();
    $posts = $Posts->create_booking($cust_name,$cust_add,$cust_add_2,$town,$postcode,$cust_email,$cust_phone,$item,$status,$amount); 
    $posts = $Posts->adjust_booking_number('up', $item); 

    session_start();
    $_SESSION['message'] = 'Client Booking Successful';
    header('Location: manageretreat.php');
            

?>