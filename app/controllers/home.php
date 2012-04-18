<?php

class Home extends Controller {

	function Home()	{
		parent::Controller();
		$uri = uri_string();
		if(!empty($uri))	{
			$uri = substr($uri,0,14); //clean, make sure this coordinates with rnd generator in logic.php
			$uri = htmlentities($uri); //clean
			$uri_array = explode('/',$uri);
			
			if(sizeof($uri_array) < 3)	{
				$url = $uri_array[1];
				$data = $this->logic_model->get($url);
			}
			
			if($this->input->post("token"))	{
				if($this->input->post("token") == $this->session->userdata("token"))	{
					$this->_delete_url($url);	
					$redirect = '/'.$url;
					redirect($redirect);
				}
			}
			
			if(!empty($data) && ($data['created'] + $data['expiration']) > time())	{
				$data['plusCount'] = ($data['created'] + $data['expiration']) - time();
				$data['token'] = $this->_create_token();
				$this->load->view('details_view',$data);
			}	else	{
				show_404($uri);
			}
		}	else	{
			$data['token'] = $this->_create_token();
			$this->load->view('home_view',$data);	
		}
	}
	
	function index()	{
	}
	
	function _create_token()	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	function _delete_url($url)	{
		$this->load->model('logic_model');
		$result = $this->logic_model->delete_url($url);
		$log = 'Manual Bomb on '.date('M j, Y',time()).' at '.date('g:i:s',time()).'. Rows Affected: '.$result;
		log_message('error',$log);
	}
}

/* EOF */