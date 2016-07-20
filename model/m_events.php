<?php

class Posts
{   
    public $Database;


function __construct()
    {
        global $Database;

            $server   = 'localhost';
            $user     = 'root';
            $pass     = '';
            $db       = 'scottjose';
            $Database = new mysqli($server, $user, $pass, $db); 
            $this->Database = $Database;
    }

    public function get_blog_posts($title = '', $status = '', $keywords = '')
        {
            if (empty($title) && empty($status) && empty($keywords))
            {
                $query = "SELECT * FROM `blog_posts` ORDER BY `timestamp` DESC";
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

            else if (!empty($title) && empty($status) && empty($keywords))
            {
                    $query = "SELECT * FROM `blog_posts` WHERE `title` = '$title'";
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

            else if (!empty($status) && empty($title) && empty($keywords))
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

            else if (!empty($keywords) && !empty($status) && empty($title))
            {
                    $query = "SELECT *, MATCH (`content`) AGAINST ('$keywords' IN NATURAL LANGUAGE MODE) AS score FROM `blog_posts` ORDER BY score DESC";
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

    public function get_retreats($location = '')
        {
            if (empty($location))
            {
                $query = "SELECT * FROM `retreats` WHERE `status` = 'Live' ORDER BY `date` DESC";
                if($stmt = mysqli_prepare($this->Database, $query))
                {
                    mysqli_stmt_execute($stmt);
                    $resultObject = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                }
                    $retreats = array();
                    $size = mysqli_num_rows($resultObject);
                    for($i = 0; $i < $size; $i++)
                {
                    $retreats[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
                }
                return $retreats;
            }
            else
            {
                $query = "SELECT * FROM `retreats` WHERE `location` = '$location' AND `status` = 'Live' ORDER BY `date` DESC";
                if($stmt = mysqli_prepare($this->Database, $query))
                {
                    mysqli_stmt_execute($stmt);
                    $resultObject = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                }
                    $retreats = array();
                    $size = mysqli_num_rows($resultObject);
                    for($i = 0; $i < $size; $i++)
                {
                    $retreats[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
                }
                return $retreats;
            }
        }



    public function get_Insta()
    {
        // Supply a user id and an access token
        $userid = "340305144";
        $accessToken = "340305144.ab103e5.3451aa2542694bb78066f3d0e15eace8";

        $url = "https://api.instagram.com/v1/users/".$userid."/media/recent/?access_token=".$accessToken."&count=8";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch); 
        $result = json_decode($result);
        return $result;
    }

    public function create_retreat_order($cust_name,$cust_add,$cust_add_2,$town,$postcode,$cust_email,$cust_phone,$item,$status,$amount) 
    {   


    $t = time();
    $date = date("Y-m-d");

    $stmt = $this->Database->prepare("INSERT INTO `retreat_orders` (`cust_name`,`cust_add`,`cust_add_2`,`town`,`postcode`,`cust_email`,`cust_phone`,`item`,`date`,`status`,`amount`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); //prepare main query
                
    $stmt->bind_param('ssssssisssi', $cust_name,$cust_add,$cust_add_2,$town,$postcode,$cust_email,$cust_phone,$item,$date,$status,$amount);

    $stmt->execute(); //run query
    $stmt->close();

    }

    public function update_retreat_order() 
    {   

    $confirmed = 'Confirmed';

            $sql = "SELECT MAX(`id`) FROM `retreat_orders`";
            $result = $this->Database->query($sql);

            if ($result->num_rows > 0) 
            {
                // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                    $result1 =  implode($row);
                }
            } 

          $stmt = $this->Database->prepare("UPDATE `retreat_orders` SET `status`= ? WHERE `id` = $result1"); //prepare main query
                        
          $stmt->bind_param('s', $confirmed);

          $stmt->execute(); //run query
          $stmt->close(); 

    }

    public function create_training_order($name, $address, $email_address, $phone, $dbitems, $date) 
    {   


    $stmt = $this->Database->prepare("INSERT INTO `training_orders` (`cust_name`, `cust_add`, `cust_email`, `cust_phone`, `item`, `date`) VALUES (?, ?, ?, ?, ?, ?)"); //prepare main query
                
    $stmt->bind_param('sssiss', $name, $address, $email_address, $phone, $dbitems, $date);

    $stmt->execute(); //run query
    $inv_no = $this->Database->insert_id;
    $stmt->close();
        
    return $inv_no; 

    }


}   
