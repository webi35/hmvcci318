<?php

/**
* 
*/
class Users extends Auth_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		
		var_dump(get_defined_vars());
		
		$this->a_kolom[] = array('label' => 'No', 'field' => 'no:');
		$this->a_kolom[] = array('label' => 'Nama', 'field' => 'user_firstname');
		$this->a_kolom[] = array('label' => 'Email', 'field' => 'user_email');
		$this->a_kolom[] = array('label' => 'No HP', 'field' => 'user_mobile');
		$this->a_kolom[] = array('label' => 'Aktif', 'field' => 'user_active');

		$a_data = array();
		foreach ($this->a_data as $key => $row) 
		{
			foreach ($this->a_kolom as $k => $v) 
			{
				$field = $v['field'];

				if($field == 'no:')
				{
					$val  = '';
				}
				else if($field == 'user_active')
				{
					$val  = $row['user_active'] == '1' ? '<span class="label label-success">Aktif</span>' : '<span class="label label-danger">Tidak Aktif</span>';
				}
				else{
					$val  = $row[$field];
				}				
				
				$a_data[$key][$field] = $val;
			}

		}


		$this->a_data = $a_data;

		parent::listdata();
	}


	function add()
	{
		parent::add();
	}
}