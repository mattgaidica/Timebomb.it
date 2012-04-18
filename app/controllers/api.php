<?php
class Api extends Controller {

	function Api()	{
		parent::Controller();	
	}

	function index()	{
		show_404('API URL incomplete');
	}
	
	function json($key='',$username='',$password='',$expiration='')	{
		$input_array = array(
					"output"=>"json",
					"key"=>$key,
					"username"=>$username,
					"password"=>$password,
					"expiration"=>$expiration
					);
		$this->_process_api($input_array);
	}

	function _process_api($input_array)	{
		$error = FALSE;
		if($this->api_model->check_key($input_array['key']) == TRUE)	{
			$this->api_model->increment_request($input_array['key']);
			$clean_inputs = $this->validatebomb->clean_inputs($input_array);
			if($clean_inputs == TRUE)	{
				$url = $this->validatebomb->get_valid_url();
				$add_data = array(
					'username' => $clean_inputs['username'], 
					'password' => $clean_inputs['password'],
					'comments' => '',
					'url' => $url,
					'expiration' => $clean_inputs['expiration'],
					'created' => time()
					);
				$result = $this->logic_model->add($add_data);
				if(!is_int($result))
					$error = TRUE;
			}	else	{$error = TRUE;}
	  
			switch ($input_array['output']) {
				default:
					$api_view = "api_json_view";
			}
			if($error == FALSE)	{
				$add_data['url'] = "http://timebomb.it/".$add_data['url'];
				$this->load->view($api_view,$add_data);
			}	else	{
				$this->load->view("api_error_view");
			}
		}	else	{
			$error_string = "Key Error:".$input_array['key'];
			show_404($error_string);	
		}
	}
}