<?php

class Users
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


    public function register_user() 
        {   

        $name       = $_POST['name'];
        $email      = $_POST['email'];
        $phone      = $_POST['phone'];
        $dob        = $_POST['dob'];
        $ecn        = $_POST['ecn'];
        $ecp        = $_POST['ecp'];
        $address    = $_POST['address'];
        $address2   = $_POST['address2'];
        $city       = $_POST['city'];
        $county     = $_POST['county'];
        $postcode   = $_POST['postcode'];
        $event_id   = $_POST['event_id'];

    
        $stmt = $this->Database->prepare("INSERT INTO `participant` (`p_name`, `p_email`, `p_phone`, `p_dob`, `p_emerg_name`, `p_emerg_phone`, `p_address`, `p_address_2`, `p_town`, `p_county`, `p_postcode`, `p_event`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); //prepare main query
                    
        $stmt->bind_param('ssississsssi', $name, $email, $phone, $dob, $ecn, $ecp, $address, $address2, $city, $county, $postcode, $event_id);

        $stmt->execute(); //run query
        $stmt->close();
        }

    public function get_user($user_id = '')
        {
            if (empty($user_id) )
            {
                $query = "SELECT * FROM `participant` LEFT JOIN `events` ON `events`.event_id = `participant`.p_event";
                if($stmt = mysqli_prepare($this->Database, $query))
                {
                    mysqli_stmt_execute($stmt);
                    $resultObject = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                }
                    $users = array();
                    $size = mysqli_num_rows($resultObject);
                    for($i = 0; $i < $size; $i++)
                {
                    $users[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
                }
                return $users;

                } 
                else 
                {
                    $query = "SELECT * FROM `participant` LEFT JOIN `events` ON `events`.event_id = `participant`.p_event WHERE `user_id` = $user_id";
                    if($stmt = mysqli_prepare($this->Database, $query))
                {
                    mysqli_stmt_execute($stmt);
                    $resultObject = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                }
                    $users = array();
                    $size = mysqli_num_rows($resultObject);
                    for($i = 0; $i < $size; $i++)
                {
                    $users[$i] = mysqli_fetch_array($resultObject, MYSQLI_ASSOC);
                }

                return $users;
                }
       }


   }