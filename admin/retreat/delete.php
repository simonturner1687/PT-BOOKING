<?php

$id = $_GET['id'];

include '/model/m_events.php';
$Posts = new Posts();
$posts = $Posts->delete_post($id);

session_start();
$_SESSION['message'] = 'Post Delete Successful';
header('Location: trash_posts.php');

?>