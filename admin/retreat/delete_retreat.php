<?php

$id = $_GET['id'];

include '/model/m_events.php';
$Posts = new Posts();
$posts = $Posts->delete_retreat_order($id);

session_start();
$_SESSION['message'] = 'Retreat Delete Successful';
header('Location: manageretreat.php');

?>