<?php
#upload an image and also creating a thumbnail for the image 
function upload_image($file_tmp, $file_ext, $file_name)
{

    $album_id = (int)$album_id;

    mysql_query("INSERT INTO `images` VALUES ('', '" . $_SESSION['user_id'] . "', '$album_id', UNIX_TIMESTAMP(), '$file_ext')");

    $image_id = mysql_insert_id();
    $image_file = $image_id . '.' . $file_ext;
    //move_uploaded_file($file_tmp, 'uploads/' . $album_id . '/' . $image_file);

    $destination_url = 'uploads/' . $image_file;
    $quality = 60;

    $info = getimagesize($file_tmp);

    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($file_tmp);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($file_tmp);
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($file_tmp);

    //save file
    imagejpeg($image, $destination_url, $quality);

}


?>