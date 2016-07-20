<?php

include 'model/m_events.php';

$title          = $_POST['title'];
$content        = $_POST['content'];
$topic          = $_POST['topic'];
$author         = $_POST['author'];
$short_content  = $_POST['short_content'];
$status         = $_POST['submit'];
$id             = $_POST['id'];

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

        if (empty($file_name)) 
        {
            $Posts = new Posts();
            $posts = $Posts->save_post($title, $content, $topic, $author, $short_content, $status, $file_tmp, $file_ext, $file_name, $id); 
            session_start();
            $_SESSION['message'] = 'Post Update Successful';
            header('Location: manageblog.php');
        }
        else
        {
        if(in_array($file_ext, $allowed_ext) === false)
        {
            $errors[]="Unsupported file type";
        } 
        if($_FILES['files']['size'][$key] > 12582912)
        {
            $errors[]='File size must be less tham 12 MB';
        }
        }
        
        if (!empty($errors)) 
        {
            foreach ($errors as $error) 
            {
                echo '<br />';
                echo $error . '<br>';

                exit();
            }
        }
        else
        {
            $Posts = new Posts();
            $posts = $Posts->save_post($title, $content, $topic, $author, $short_content, $status, $file_tmp, $file_ext, $file_name, $id);    
            session_start();
            $_SESSION['message'] = 'Post Update Successful';
            header('Location: manageblog.php');
        }
    }           

}
            

?>