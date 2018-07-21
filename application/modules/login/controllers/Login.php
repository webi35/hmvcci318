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

	public function ceklogin()
	{
		
		$this->load->library('form_validation');

		$config = array(
		       
		        array(
		                'field' => 'user_password',
		                'label' => 'Password',
		                'rules' => 'trim|required'
		        ),
		        array(
		                'field' => 'user_name',
		                'label' => 'Email',
		                'rules' => 'trim|required|valid_email'
		        )
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
        }

        $this->load->model('Users/M_Users');

        $user_name 		= $this->input->post('user_name');
        $password 		= $this->input->post('user_password');

        //echo password_hash('admin', PASSWORD_BCRYPT); die();

       	$user = $this->M_Users->get_user($user_name);
		$hash = $user->user_password;

		$verified = $this->_verify_password_hash($password, $hash);

       	if(!$verified){
       		$this->session->set_flashdata('error', 'Login Gagal');
        	return redirect('login');
       	}

       	$ip_address = $this->input->ip_address();

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

	private function _verify_password_hash($password, $hash)
	{
		return password_verify($password, $hash);
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
