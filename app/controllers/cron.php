<?php

class Cron extends Controller {

	function Cron()	{
		parent::Controller();
		if($_SERVER['SERVER_ADDR'] != $_SERVER['REMOTE_ADDR'])	{
			show_404('Invalid Cron Job Execution');
			die();	
		}
	}
	
	function api()	{
		$result = $this->api_model->reset_requests();
		$log = 'Cron-Reset-Requests ran on '.date('M j, Y',time()).' at '.date('g:i:s',time()).'. Rows Affected: '.$result;
		log_message('error',$log);
	}
	
	function clean()	{
		$result = $this->logic_model->clean();
		$log = 'Cron-Clean ran on '.date('M j, Y',time()).' at '.date('g:i:s',time()).'. Rows Affected: '.$result;
		log_message('error',$log);
	}
}