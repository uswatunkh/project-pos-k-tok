<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_backend {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb/untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('System');
		$this->breadcrumb->add_crumb('Profile');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> System';
		$this->data['sub_primary_title'] = 'profile setting';
		
		$this->data['sub_title'] = 'Users Profile';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_users = $this->data['tables']['prefix'].'users'; 
			
		$this->validation_rule();
	}
	
	// {VIEW} //
	function index(){
		
	}
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
			array(
				 'field'   => 'first_name',
				 'label'   => 'Name',
				 'rules'   => 'required|min_length[2]'
			  ),
			array(
				 'field'   => 'username',
				 'label'   => 'Username',
				 'rules'   => 'required|min_length[2]'
			  ),
		   	array(
				 'field'   => 'password',
				 'label'   => 'Password',
				 'rules'   => 'trim|required|matches[password_confirm]'
			  ),
			array(
				 'field'   => 'password_confirm',
				 'label'   => 'Password Confirm',
				 'rules'   => 'trim|required'
			  ),
		   	array(
				 'field'   => 'email',
				 'label'   => 'Email',
				 'rules'   => 'required|valid_email'
			  )
	   	);
		
		$this->data['rules_message'] = array();
	}
	
	function edit(){
		$this->data['rules'] = array(
			array(
				 'field'   => 'email',
				 'label'   => 'Email',
				 'rules'   => 'required|valid_email'
			  ),
			array(
				 'field'   => 'first_name',
				 'label'   => 'Name',
				 'rules'   => 'required|min_length[2]'
			  ),
		   	array(
				 'field'   => 'password',
				 'label'   => 'Password',
				 'rules'   => 'trim|matches[password_confirm]'
			  ),
			array(
				 'field'   => 'password_confirm',
				 'label'   => 'Password Confirm',
				 'rules'   => 'trim'
			  )
	   	);
		
		//$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$id = $this->data['user']->id;
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->data['list'] = $this->wd_db->get_data_row($this->table_users,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function update_action(){
		$this->data['rules'] = array(
			array(
				 'field'   => 'email',
				 'label'   => 'Email',
				 'rules'   => 'required|valid_email'
			  ),
			array(
				 'field'   => 'first_name',
				 'label'   => 'Name',
				 'rules'   => 'required|min_length[2]'
			  ),
		   	array(
				 'field'   => 'password',
				 'label'   => 'Password',
				 'rules'   => 'trim|matches[password_confirm]'
			  ),
			array(
				 'field'   => 'password_confirm',
				 'label'   => 'Password Confirm',
				 'rules'   => 'trim'
			  )
	   	);
		
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$data = array(
					'email' => $this->input->post('email'),
					'first_name' => $this->input->post('first_name'),
					'phone'      => $this->input->post('phone')
				);

		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);
		
		$user = $this->ion_auth->user($id)->row();
		
		// update the password if it was posted
		if ($this->input->post('password'))
		{
			$data['password'] = $this->input->post('password');
		}
		
		$this->ion_auth->update($user->id, $data);
			
		redirect(admin_dir().this_module().'/edit');
		
	}
}