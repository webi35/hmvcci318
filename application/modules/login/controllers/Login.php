<?php

/**
* 
*/
class Login extends Front_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		$this->load->view("login/login_v", $this->data);

	}

}