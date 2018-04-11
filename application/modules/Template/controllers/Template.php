<?php

/**
* 
*/
class Template extends MY_Controller
{
	
	function __construct()
	{
		# code...
	}

	function sample_template($data = null)
	{
		$this->load->view("Template/sample_template_v", $data);
	}

	function admin_template($data = null)
	{
		$this->load->view("Template/admin_template_v", $data);
	}
}