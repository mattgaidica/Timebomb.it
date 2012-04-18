<?php

class Api_model extends Model{
	function __construct()	{
		parent::Model();	
	}
	
	function reset_requests()	{
		$this->db->query("UPDATE api SET daily_requests=0");
	}
	
	function increment_request($api_key)	{
		$q = "UPDATE api SET daily_requests=daily_requests+1,total_requests=total_requests+1 WHERE api_key='".mysql_real_escape_string($api_key)."'";
		$this->db->query($q);
	}

	function check_key($api_key)	{
		$this->db->where('api_key',mysql_real_escape_string($api_key));
		$q = $this->db->get('api');
		
		if($q->num_rows() > 0)	{
			$row = $q->row();
			if($row->daily_requests < $row->request_limit)
				return TRUE;
			else
				return FALSE;
		}	else	{return FALSE;}
	}
}