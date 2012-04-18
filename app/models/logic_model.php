<?php

class Logic_model extends Model{
	function __construct()	{
		parent::Model();	
	}
	
	function add($data)	{
		$encrypted_url = $this->config->item('encryption_key').$data['url'];
		$db = array(
			'username'=>$this->encrypt->encode($data['username'],$encrypted_url),
			'password'=>$this->encrypt->encode($data['password'],$encrypted_url),
			'comments'=>$this->encrypt->encode($data['comments'],$encrypted_url),
			'url'=>sha1($encrypted_url),
			'expiration'=>$data['expiration'],
			'created'=>$data['created']
		);
		$this->db->insert('main',$db);
		$insert_id = $this->db->insert_id();	
		
		$urls_insert = array('url'=>sha1($encrypted_url));
		$this->db->insert('urls',$urls_insert);
		
		return $insert_id;
	}
	
	function get($url)	{
		$encrypted_url = $this->config->item('encryption_key').mysql_real_escape_string($url);
		$this->db->where('url',sha1($encrypted_url));
		$q = $this->db->get('main');
		
		if($q->num_rows() > 0)	{
			$row = $q->row();
			$data = array(
						'id'=>$row->id,
						'username'=>$this->encrypt->decode($row->username,$encrypted_url),
						'password'=>$this->encrypt->decode($row->password,$encrypted_url),
						'comments'=>$this->encrypt->decode($row->comments,$encrypted_url),
						'url'=>$url,
						'expiration'=>$row->expiration,
						'created'=>$row->created
						);

			return $data;
		}
		else
			return array();
	}	
		
	function delete_url($url)	{
		$encrypted_url = $this->config->item('encryption_key').mysql_real_escape_string($url);
		$this->db->where('url',sha1($encrypted_url));
		$this->db->delete('main');
		return $this->db->affected_rows();	
	}
	
	function clean()	{
		$this->db->query("DELETE FROM main WHERE UNIX_TIMESTAMP() >= (main.expiration + main.created + 3600)");
		return $this->db->affected_rows();
	}

	function is_existing_url($url)	{
		$encrypted_url = $this->config->item('encryption_key').mysql_real_escape_string($url);
		$this->db->where('url',sha1($encrypted_url));
		$q = $this->db->get('urls');	
		if($q->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}
}