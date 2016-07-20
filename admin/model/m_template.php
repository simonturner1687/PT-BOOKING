<?php

/*
	Template Class
	HAndle all templating tasks -
	Displaying views, Alerts,
	errors and data
*/

Class Template 
{
	private $data;
	private $alert_types = array('success', 'alert', 'error');

	function __construct() {}

	/**
	* Loads specified url
	*
	* @access public
	* @param string, string
	* @return null
	*/
	public function load($url, $title = '')
	{
		if($title != '') {$this->set_data('page_title', $title); } 
		include($url);
	}
	
	/**
	* redirects specified url
	*
	* @access public
	* @param string
	* @return null
	*/
	public function redirect($url)
	{
		header("Location:$url");
		exit;
	}


	/*
		Get / Set data
	*/

	/**
	* saves provided data for use by view later
	*
	* @access public
	* @param string, string, bool
	* @return null
	*/
	public function set_data($name, $value, $clean = FALSE)
	{
		if($clean == TRUE)
		{
			$this->data[$name] = htmlentities($value, ENT_QUOTES);
		}
		else
		{
			$this->data[$name] = $value;
		}
	}	

	/**
	* Retrieves data based on provided name for access view
	*
	* @access public
	* @param string, bool
	* @return string
	*/
	public function get_data($name, $echo = TRUE)
	{
		if(isset($this->data[$name]))
		{
			if($echo)
			{
				echo $this->data[$name];
			}
			else
			{
				return $this->data[$name];
			}
		}
		return '';
	}


	/*
		Get / Set Alerts
	*/

	/**
	* Sets alert message stored in session variable
	*
	* @access public
	* @param string, string(optional)
	* @return null
	*/
	public function set_alert($value, $type = 'success')
	{
		$_SESSION[$type][] = $value;
	}

	/**
	* Returns string, containing multiple list items of alerts
	*
	* @access public
	* @param 
	* @return string
	*/
	public function get_alerts()
	{
		$data = ''; // create blank variable

		foreach($this->alert_types as $alert) //loop through each of the alerts set at the top
		{
			if(isset($_SESSION[$alert])) //checks to see which alerts have been set
			{
				foreach($_SESSION[$alert] as $value) //stores each alert type as value
				{
					$data .='<li class="'.$alert.'">'.$value.'</li><br>'; //prints set alert(s) in list
				}
				unset($_SESSION[$alert]); //removes stored session information (alert type)
			}
		}
		echo $data; // prints alert type
	} 



}