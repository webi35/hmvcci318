<?php

/**
* 
*/
class Admin extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->modules(['Books']);
	}

	function index()
	{
		$data['content_view'] = 'Admin/dashboard1_v';
		$this->template->admin_template($data);
	}

	function dash2()
	{
		$data['content_view'] = 'Dashboard/dashboard2_v';
		$this->template->admin_template($data);
	}

	function books()
	{
		$this->books->display_books();
	}

	function addBook()
	{
		$this->books->addBook();
	}
}