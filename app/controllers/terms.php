<?php

class Terms extends Controller {

	function Terms()	{
		parent::Controller();
	}
	
	function index()	{
		$this->load->view('terms_view');
	}	
}

/* EOF */