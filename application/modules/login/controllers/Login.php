<?php

/**
*
*/
class Login extends Front_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('google');
	}

	function index()
	{
		$this->data['loginwithgoogle'] = $this->google->loginURL();
		$this->load->view("login/login_v", $this->data);
	}

	function loginwithgoogle()
	{
		if(isset($_GET['code']))
		{
			$this->google->getAuthenticate();

			$getToken =  $this->google->getAccessToken();

			$access_token = $getToken['access_token'];

		}

		$getUserInfo = $this->google->getUserInfo();

		//cek, apakah user?
		$this->load->model('Users/M_Users');

		$user_name = $getUserInfo['email'];

		$user = $this->M_Users->get_user($user_name);

		if($user == false)
		{
			$this->session->set_flashdata('error', 'Maaf, email anda belum terdaftar');
      return redirect('login');
		}

		//google session
		$session_user['loginwith'] 		= 'google';
		$session_user['access_token'] 	= $access_token;
		$session_user['picture'] 		= $getUserInfo['picture'];

		$session_user['loged_in'] 		= TRUE;
		$session_user['user_id'] 		= $user->user_id;
		$session_user['ip_address'] 	= $user->ip_address;

		$session_user['user_name'] 		= $user->user_name;
		$session_user['user_email'] 	= $user->user_email;
		$session_user['user_firstname'] = $user->user_firstname;
		$session_user['user_lastname'] 	= $user->user_lastname;

		$this->session->set_userdata($session_user);

		return redirect('admin');

	}

}
