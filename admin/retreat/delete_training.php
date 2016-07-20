<?php

$id = $_GET['id'];

include '/model/m_events.php';
$Posts = new Posts();
$posts = $Posts->delete_training_order($id);

session_start();
$_SESSION['message'] = 'Booking Delete Successful';
header('Location: bookedpaces.php');

?>