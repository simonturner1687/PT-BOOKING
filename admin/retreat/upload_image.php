<?php

include 'model/m_events.php';

$location       = $_POST['location'];
$hotel          = $_POST['hotel'];
$type           = $_POST['type'];
$short_content  = $_POST['short_content'];
$content        = $_POST['content'];
$date           = $_POST['date'];
$fullprice      = $_POST['fullprice'];
$deposit        = $_POST['deposit'];
$open           = $_POST['open'];
$filled         = $_POST['filled'];
$status         = $_POST['submit'];



$no = 1;
foreach ($_FILES as $file) 
{
    if (array_key_exists('error', $file) && $file['error'] == 4) 
    {
       
        ${'image_' . $no} = ''; 
        $no++;
    }

    else
    {

        ${'image_' . $no} = array();
        ${'image_' . $no} = array('name' => $file['name'],'type' => $file['type'], 'tmp_name' => $file['tmp_name'], 'error' => $file['error'], 'size' => $file['size']) ; 
        $no++;

    }

}

$imagearray = array();
$imagearray = array($image_1, $image_2, $image_3, $image_4, $image_5, $image_6);




foreach ($imagearray as $image )
{
    if (!empty($image['name']))
    {

            $file_name = $image['name'];
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_ext = $image['type'];

            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            
            $file_ext = strtolower($file_ext);
            $file_ext = substr($file_ext, 6);
        
            $errors = array();

            if(in_array($file_ext, $allowed_ext) === false)
            {
                $errors[]="Unsupported file type";
            } 

            if($image['size'] > 12582912)
            {
                $errors[]='File size must be less tham 12 MB';
            }
            
            if (!empty($errors)) 
            {
                foreach ($errors as $error) 
                {
                    echo '<br />';
                    echo $error . '<br>';
                    session_start();
                    $_SESSION['message'] = 'Retreat not changed - '.$error;
                    header('Location: manageretreat.php');

                    exit();
                }
            }


                $destination_url = 'images/retreat_images/'.$file_name;
                $quality = 60;

                $info = getimagesize($file_tmp);

                if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($file_tmp);
                elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($file_tmp);
                elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($file_tmp);

                //save file
                imagejpeg($image, $destination_url, $quality);

        }
    }

        $Posts = new Posts();
        $posts = $Posts->create_retreat($location, $hotel, $type, $short_content, $content, $date, $fullprice, $deposit, $open, $filled, $status, $image_1['name'], $image_2['name'], $image_3['name'], $image_4['name'], $image_5['name'], $image_6['name']);    
        session_start();
        $_SESSION['message'] = 'Retreat Creation Successful';
        header('Location: manageretreat.php');                      

?>