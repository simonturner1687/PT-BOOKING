<?php

$id = $_GET['id'];

include '/model/m_events.php';
$Posts = new Posts();
$posts = $Posts->trash_retreat($id);

session_start();
$_SESSION['message'] = 'Retreat Archived';
header('Location: trash_retreats.php');

?>