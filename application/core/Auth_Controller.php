<?php
class Auth_Controller extends MX_Controller
{

	
	public $ctl;
	public $method;

	public $c_edit = true;


	public $a_kolom = array();
	public $data = array();

	public $a_data = array();


	function __construct()
	{
		parent::__construct();

		$this->is_loged_in();

		$this->load->module('Template');

		$this->ctl = $this->uri->segment(1);
		$this->method = $this->uri->segment(2);

		$this->data['ctl'] = $this->ctl;

		$this->data['page_header'] = $this->ctl;
		$this->data['description'] = 'Halaman ' . $this->ctl;

		$this->data['c_edit'] = $this->c_edit;

		//load model
		$model = $this->ctl.'/M_'.$this->ctl;
		$this->load->model($model);

		$this->data['buttons'] = array();

		//set table
		$this->load->library('table');

		$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered table-striped">' );
		
		$this->a_data = $this->M_users->getList();

		$this->table->set_template($tmpl);
	}


	function is_loged_in(){
		$loged_in = $this->session->userdata('loged_in');

		$user_id = $this->session->userdata('user_id');

		if(!$loged_in && empty($user_id))
		{
			redirect();
		}
	}

	function listdata()
	{
		
		$this->data['content_view'] = 'inc_table_generate';
		
		$this->data['page_header'] = $this->ctl;
		$this->data['description'] = 'Data ' . $this->ctl;

		$this->data['buttons']['add'] 	= array('action' => $this->ctl . '/add', 'class' => 'success', 'value' => 'Tambah');

		$no = 0;
		foreach ($this->a_data as $key => $row) {
			$no++;

			foreach ($this->a_kolom as $k => $v) {
				
				$field = $v['field'];
				
				if($field == 'no:'){
					$col[$key][] = $no;
				}
				else{
					$col[$key][] = $row[$field];
				}
				
			}
		
			if($this->c_edit){
				$col[$key][] = 'Edit';
			}

			$this->table->add_row($col[$key]);
		}

		$th = array();
		foreach ($this->a_kolom as $k => $v) {
			$th[] = $v['label'];
		}

		if($this->c_edit){
			$th[] = 'Aksi';
		}

		$this->table->set_heading($th);

		$this->data['table_generate'] = $this->table->generate();

		$this->template->admin_template($this->data);
	}

	function add()
	{
		$this->data['content_view'] = 'inc_data_v';
		
		$this->data['page_header'] = $this->ctl;
		$this->data['description'] = 'Data ' . $this->ctl;

		$this->data['buttons']['add'] 	= array('action' => $this->ctl . '/add', 'class' => 'success', 'value' => 'Tambah');

		$this->data['buttons']['back'] 	= array('action' => $this->ctl, 'class' => 'default', 'value' => 'Kembali');

		$this->data['description'] = 'Form ';

		$this->template->admin_template($this->data);
	}

}