<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validatebomb {
	
	function __construct()	{
		$this->ci =& get_instance();
	}

	function clean_inputs($data)	{	
		if(!empty($data['username']))	{
			$username = trim($data['username']);
			$username = $this->ci->input->xss_clean($username);
			$username = htmlentities($username);
			$username = mysql_real_escape_string($username);
			if(strlen($username) <= 50) 	{
				$return['username'] = $username;
			}	else {return FALSE;}
		} else {$return['username'] = '';}
		
		if(!empty($data['password']))	{
			$password = trim($data['password']);
			$password = $this->ci->input->xss_clean($password);
			$password = htmlentities($password);
			$password = mysql_real_escape_string($password);
			if(strlen($password) <= 50 && strlen($password) > 0)	{
				$return['password'] = $password;
			}	else {return FALSE;}
		} else {return FALSE;}
	
		if(!empty($data['comments']))	{
			$comments = trim($data['comments']);
			$comments = $this->ci->input->xss_clean($comments);
			$comments = htmlentities($comments);
			$comments = mysql_real_escape_string($comments);
			if(strlen($comments) <= 300)	{
				$return['comments'] = $comments;
			}	else {return FALSE;}
		} else {$return['comments'] = '';}
		
		if(!empty($data['expiration']))	{
			$expiration = trim($data['expiration']);
			if(strlen($expiration) == 1)	{
				if((int)$expiration == 1 || (int)$expiration == 2 || (int)$expiration == 3)	{
					$return['expiration'] = 3600;
					if((int)$expiration == 2) //1 Hour
						$return['expiration'] = 86400; 
					if((int)$expiration == 3) //1 Hour
						$return['expiration'] = 604800;
				}	else {return FALSE;}
			}	else {return FALSE;}
		} else {return FALSE;}
		
		return $return;	
	}
	
	function get_valid_url()	{
		$is_existing = TRUE;
		while($is_existing)	{
			$url = strtolower(random_string('alnum',10));
			$is_existing = $this->ci->logic_model->is_existing_url($url);
		}
		return $url;
	}
}