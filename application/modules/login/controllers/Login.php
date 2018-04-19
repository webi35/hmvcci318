<?php

/**
* 
*/
class Login extends Front_Controller
{
	
	function __construct()
	{
		parent::__construct();

		//load google login library
        $this->load->library('google');
        
        //load user model
        $this->load->model('users');

	}

	function index()
	{
		
		$this->load->view("login/login_v", $this->data);

	}

	function loginwithgoogle()
	{
		
	}

}