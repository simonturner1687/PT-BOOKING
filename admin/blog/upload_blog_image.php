<?php

include 'model/m_events.php';

$title          = $_POST['title'];
$content        = $_POST['content'];
$topic          = $_POST['topic'];
$author         = $_POST['author'];
$short_content  = $_POST['short_content'];
$status         = $_POST['submit'];



if (isset($_FILES['files'])) 
    { 
    
    foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
    {
        $file_name = $key.$_FILES['files']['name'][$key];
        $file_size = $_FILES['files']['size'][$key];
        $file_tmp = $_FILES['files']['tmp_name'][$key];
        $file_ext = $_FILES['files']['type'][$key];

        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
        
        $file_ext = strtolower($file_ext);
        $file_ext = substr($file_ext, 6);
    
        $errors = array();

        if(in_array($file_ext, $allowed_ext) === false)
        {
            $errors[]="Unsupported file type";
        } 
        if($_FILES['files']['size'][$key] > 12582912)
        {
            $errors[]='File size must be less tham 12 MB';
        }
    }
        

        if (empty($_FILES['name']))
        {
            $Posts = new Posts();
            $posts = $Posts->create_post($title, $content, $topic, $author, $short_content, $status, $file_tmp, $file_name);            
            session_start();
            $_SESSION['message'] = 'Post Created Successfully';
            header('Location: manageblog.php');
        }
        else if (!empty($errors)) 
        {
            foreach ($errors as $error) 
            {

                session_start();
                $_SESSION['message'] = $error;
                header('Location: manageblog.php');

                exit();
            }
        }
        else
        {
            $Posts = new Posts();
            $posts = $Posts->create_post($title, $content, $topic, $author, $short_content, $status, $file_tmp, $file_name);            
            session_start();
            $_SESSION['message'] = 'Post Created Successfully';
            header('Location: manageblog.php');
        }
    }           
            

?>