 <?php
class Create extends Controller {

	function Create()	{
		parent::Controller();	
	}

	function index()	{
		if($this->input->post("token") == $this->session->userdata("token"))	{
			$post_array = array(
				"password"=>$this->input->post("password"),
				"username"=>$this->input->post("username"),
				"comments"=>$this->input->post("comments"),
				"expiration"=>$this->input->post("expiration")
				);
			$clean_inputs = $this->validatebomb->clean_inputs($post_array);
			if($clean_inputs != FALSE)	{
				$url = $this->validatebomb->get_valid_url();
				$add_data = array(
					'username' => $clean_inputs['username'], 
					'password' => $clean_inputs['password'], 
					'comments' => $clean_inputs['comments'],
					'url' => $url,
					'expiration' => $clean_inputs['expiration'],
					'created' => time()
					);
				$this->load->model('logic_model');
				$result = $this->logic_model->add($add_data);
				$redirect = '/'.$add_data['url'];
				redirect($redirect);
			}
		}
		redirect('');
	}
}

/* EOF */