<?php

class About extends Controller {

	function About()	{
		parent::Controller();
	}
	
	function index()	{
		$this->load->view('about_view');
	}	
}

/* EOF */