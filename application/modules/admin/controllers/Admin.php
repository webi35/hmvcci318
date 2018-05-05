<?php

/**
* 
*/
class Admin extends Auth_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->data['content_view'] = 'admin/dashboard1_v';
		
		$this->template->admin_template($this->data);
	}

	function dash2()
	{
		$data['content_view'] = 'Dashboard/dashboard2_v';
		$this->template->admin_template($data);
	}

	function git_pull()
	{
		// Print the exec output inside of a pre element
		print("<pre>" . $this->execPrint("git pull https://github.com/landung/hmvcci318.git master") . "</pre>");
	}

	function execPrint($command) {
		
		$result = array();
		exec($command, $result);
		foreach ($result as $line) {
			print($line . "\n");
		}
	}

}