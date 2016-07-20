<?php

$id = $_GET['id'];

include '/model/m_events.php';
$Posts = new Posts();
$posts = $Posts->trash_post($id);

session_start();
$_SESSION['message'] = 'Post Trash Successful';
header('Location: trash_posts.php');

?>