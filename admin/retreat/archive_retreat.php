<?php

$id = $_GET['id'];

include '/model/m_events.php';
$Posts = new Posts();
$posts = $Posts->archive_retreat($id);

session_start();
$_SESSION['message'] = 'Retreat Archive Successful';
header('Location: archived_retreats.php');

?>