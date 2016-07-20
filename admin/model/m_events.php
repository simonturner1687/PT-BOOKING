<?php

class Posts
{   
    public $Database;


function __construct()
    {
        global $Database;

            $server   = '';
            $user     = '';
            $pass     = '';
            $db       = '';
            $Database = new mysqli($server, $user, $pass, $db); 
            $this->Database = $Database;
    }


    public function create_post($title, $content, $topic, $author, $short_content, $status, $file_tmp, $file_ext, $file_name) 
    {   


    $t = time();
    $timestamp = date("Y-m-d",$t);
    $image_file = substr($file_name, 1);


    $stmt = $this->Database->prepare("INSERT INTO `blog_posts` (`title`, `content`, `topic`, `author`, `short_content`, `timestamp`, `status`, `image_name`, `image_ext`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"); //prepare main query
                
    $stmt->bind_param('sssssssss', $title, $content, $topic, $author, $short_content, $timestamp, $status, $image_file, $file_ext);

    $stmt->execute(); //run query
    $stmt->close();

    $destination_url = 'images/blog_images/' . $image_file;
    $quality = 60;

    $info = getimagesize($file_tmp);

    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($file_tmp);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($file_tmp);
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($file_tmp);

    //save file
    imagejpeg($image, $destination_url, $quality);


    }

    public function create_retreat($location, $hotel, $type, $short_content, $content, $date, $fullprice, $deposit, $open, $filled, $status, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6)
    {   

        $stmt = $this->Database->prepare("INSERT INTO `retreats` (`location`, `hotel`, `type`, `short_text`, `long_text`, `date`, `fullprice`, `deposit`, `open`, `filled`, `status`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `image_6`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); //prepare main query
                    
        $stmt->bind_param('ssssssiiiisssssss', $location, $hotel, $type, $short_content, $content, $date, $fullprice, $deposit, $open, $filled, $status, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6);

        $stmt->execute(); //run query
        $stmt->close();
    }
          


    public function get_retreats($id = '', $status = '')
    {
        if (empty($id) && empty($status))
        {
            $query = "SELECT * FROM `retreats` ORDER BY `id` DESC";
            if($stmt = mysqli_prepare($this->Database, $query))
            {
                mysqli_stmt_execute($stmt);
                $resultObject = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }
                $blog_posts = array();
                $size = mysqli_num_rows($resultObject);
                for($i = 0; $i < $size; $i++)
            {
                $blog_posts[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
            }
            return $blog_posts;
            } 

            else if (!empty($id) && empty($status))
            {
                $query = "SELECT * FROM `retreats` WHERE `id` = $id";
                if($stmt = mysqli_prepare($this->Database, $query))
            {
                mysqli_stmt_execute($stmt);
                $resultObject = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }
                $blog_posts = array();
                $size = mysqli_num_rows($resultObject);
                for($i = 0; $i < $size; $i++)
            {
                $blog_posts[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
            }
            return $blog_posts;
            }

            else if (!empty($status) && empty($id))
            {
                $query = "SELECT * FROM `retreats` WHERE `status` = '$status'";
                if($stmt = mysqli_prepare($this->Database, $query))
            {
                mysqli_stmt_execute($stmt);
                $resultObject = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }
                $blog_posts = array();
                $size = mysqli_num_rows($resultObject);
                for($i = 0; $i < $size; $i++)
            {
                $blog_posts[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
            }
            return $blog_posts;                
            }

   }

    public function get_blog_posts($id = '', $status = '')
    {
        if (empty($id) && empty($status))
        {
            $query = "SELECT * FROM `blog_posts` ORDER BY `id` DESC";
            if($stmt = mysqli_prepare($this->Database, $query))
            {
                mysqli_stmt_execute($stmt);
                $resultObject = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }
                $blog_posts = array();
                $size = mysqli_num_rows($resultObject);
                for($i = 0; $i < $size; $i++)
            {
                $blog_posts[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
            }
            return $blog_posts;
            } 

            else if (!empty($id) && empty($status))
            {
                $query = "SELECT * FROM `blog_posts` WHERE `id` = $id";
                if($stmt = mysqli_prepare($this->Database, $query))
            {
                mysqli_stmt_execute($stmt);
                $resultObject = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }
                $blog_posts = array();
                $size = mysqli_num_rows($resultObject);
                for($i = 0; $i < $size; $i++)
            {
                $blog_posts[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
            }
            return $blog_posts;
            }

            else if (!empty($status) && empty($id))
            {
                $query = "SELECT * FROM `blog_posts` WHERE `status` = '$status'";
                if($stmt = mysqli_prepare($this->Database, $query))
            {
                mysqli_stmt_execute($stmt);
                $resultObject = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }
                $blog_posts = array();
                $size = mysqli_num_rows($resultObject);
                for($i = 0; $i < $size; $i++)
            {
                $blog_posts[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
            }
            return $blog_posts;                
            }
    }

    public function save_post($title, $content, $topic, $author, $short_content, $status, $file_tmp, $file_ext, $file_name, $id) 
    {   

    $t = time();
    $timestamp = date("Y-m-d",$t);
    

        if (empty($file_tmp))
        {
            $stmt = $this->Database->prepare("UPDATE `blog_posts` SET `title`= ?, `content`= ?, `topic`= ?, `author`= ?, `short_content`= ?, `timestamp`= ?, `status`= ? WHERE id = ?"); //prepare main query
                    
            $stmt->bind_param('sssssssi', $title, $content, $topic, $author, $short_content, $timestamp, $status, $id);

            $stmt->execute(); //run query
            $stmt->close();  

        }
        else
        {
            $image_file = substr($file_name, 1);
            
            $stmt = $this->Database->prepare("UPDATE `blog_posts` SET `title`= ?, `content`= ?, `topic`= ?, `author`= ?, `short_content`= ?, `timestamp`= ?, `status`= ?, `image_name`= ?, `image_ext`= ? WHERE id = ?"); //prepare main query
                        
            $stmt->bind_param('sssssssssi', $title, $content, $topic, $author, $short_content, $timestamp, $status, $image_file, $file_ext, $id);

            $stmt->execute(); //run query
            $stmt->close();

            $destination_url = 'images/blog_images/' . $image_file;
            $quality = 60;

            $info = getimagesize($file_tmp);

            if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($file_tmp);
            elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($file_tmp);
            elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($file_tmp);

            //save file
            imagejpeg($image, $destination_url, $quality);
        }
    }

    public function trash_post($id) 
    {           

            $stmt = $this->Database->prepare("UPDATE `blog_posts` SET `status`= 'trash' WHERE id = ?"); //prepare main query
                    
            $stmt->bind_param('i', $id);

            $stmt->execute(); //run query
            $stmt->close();  

    }

    public function trash_retreat($id) 
    {           

            $stmt = $this->Database->prepare("UPDATE `retreats` SET `status`= 'trash' WHERE id = ?"); //prepare main query
                    
            $stmt->bind_param('i', $id);

            $stmt->execute(); //run query
            $stmt->close();  

    }

    public function archive_retreat($id) 
    {           

            $stmt = $this->Database->prepare("UPDATE `retreats` SET `status`= 'archived' WHERE id = ?"); //prepare main query
                    
            $stmt->bind_param('i', $id);

            $stmt->execute(); //run query
            $stmt->close();  

    }

    public function delete_post($id) 
    {           

            $stmt = $this->Database->prepare("DELETE FROM `blog_posts` WHERE id = ?"); //prepare main query
                    
            $stmt->bind_param('i', $id);

            $stmt->execute(); //run query
            $stmt->close();  

    }

    public function delete_retreat_order($id) 
    {           

            $stmt = $this->Database->prepare("DELETE FROM `retreat_orders` WHERE id = ?"); //prepare main query
                    
            $stmt->bind_param('i', $id);

            $stmt->execute(); //run query
            $stmt->close();  

    }

    public function delete_training_order($id) 
    {           

            $stmt = $this->Database->prepare("DELETE FROM `training_orders` WHERE id = ?"); //prepare main query
                    
            $stmt->bind_param('i', $id);

            $stmt->execute(); //run query
            $stmt->close();  

    }


    public function get_training_orders()
    {
        $query = "SELECT * FROM `training_orders` ORDER BY `id` DESC";
        if($stmt = mysqli_prepare($this->Database, $query))
        {
            mysqli_stmt_execute($stmt);
            $resultObject = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        }
            $training_orders = array();
            $size = mysqli_num_rows($resultObject);
            for($i = 0; $i < $size; $i++)
        {
            $training_orders[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
        }
        return $training_orders;
    } 

    public function get_retreat_bookings()
    {
        $query = "SELECT * FROM `retreat_orders` ORDER BY `id` DESC";
        if($stmt = mysqli_prepare($this->Database, $query))
        {
            mysqli_stmt_execute($stmt);
            $resultObject = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        }
            $retreat_orders = array();
            $size = mysqli_num_rows($resultObject);
            for($i = 0; $i < $size; $i++)
        {
            $retreat_orders[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
        }
        return $retreat_orders;
    } 


    public function create_booking($cust_name,$cust_add,$cust_add_2,$town,$postcode,$cust_email,$cust_phone,$item,$status,$amount) 
    {   


    $date = date("d-m-Y");

    $stmt = $this->Database->prepare("INSERT INTO `retreat_orders` (`cust_name`,`cust_add`,`cust_add_2`,`town`,`postcode`,`cust_email`,`cust_phone`,`item`,`date`,`status`,`amount`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); //prepare main query
                
    $stmt->bind_param('ssssssisssi', $cust_name,$cust_add,$cust_add_2,$town,$postcode,$cust_email,$cust_phone,$item,$date,$status,$amount);

    $stmt->execute(); //run query
    
    $stmt->close(); 

    }

    public function adjust_booking_number($value, $location) 
    {   

        if ($value == 'up')
        {

            $date = date("d-m-Y");

            $stmt = $this->Database->prepare("UPDATE `retreats` SET `open`= (`open`- 1), `filled`= (`filled`+1) WHERE `location` = ?"); //prepare main query
                            
            $stmt->bind_param('s', $location);
            $stmt->execute(); //run query

            $stmt->close(); 
        }
        else if ($value == 'down')
        {
            $date = date("d-m-Y");

            $stmt = $this->Database->prepare("UPDATE `retreats` SET `open`= (`open`+ 1), `filled`= (`filled`-1) WHERE `location` = ?"); //prepare main query
                            
            $stmt->bind_param('s', $location);
            $stmt->execute(); //run query

            $stmt->close(); 
        }

    }

    public function save_retreat($id, $location, $hotel, $type, $short_content, $content, $date, $fullprice, $deposit, $open, $filled, $status, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6) 
    {    
            
            $stmt = $this->Database->prepare("UPDATE `retreats` SET `location` = ?, `hotel` = ?, `type` = ?, `short_text` = ?, `long_text` = ?, `date` = ?, `fullprice` = ?, `deposit` = ?, `open` = ?, `filled` = ?, `status` = ?, `image_1` = ?, `image_2` = ?, `image_3` = ?, `image_4` = ?, `image_5` = ?, `image_6` = ?  WHERE id = ?"); //prepare main query
                    
            $stmt->bind_param('ssssssiiiissssssss', $location, $hotel, $type, $short_content, $content, $date, $fullprice, $deposit, $open, $filled, $status, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6, $id);

            $stmt->execute(); //run query
            $stmt->close();  
    }

}   