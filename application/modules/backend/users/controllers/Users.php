<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_backend {

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
		$this->breadcrumb->add_crumb('Users');
		$this->breadcrumb->add_crumb('Users');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> System';
		$this->data['sub_primary_title'] = 'administrator setting';
		
		$this->data['sub_title'] = 'Users';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_users = $this->data['tables']['prefix'].'users'; 
		$this->users_groups = $this->data['tables']['prefix'].'users_groups';
		$this->groups = $this->data['tables']['prefix'].'groups';
			
		$this->validation_rule();
	}
	
	// {VIEW} //
	function index(){
		$this->rule->type('R');
		
		$this->layout->set_include_group('index');
		// $this->data['user_inline'] = $this->wd_db->get_data($this->table_users,array('id'=> $_SESSION['user_id']));
		// $this->debug($this->data['user_inline']);
		$this->data['no_delete'] = $this->wd_db->get_data($this->table_users,array('no_delete'=>'1'));
		$this->layout->set_include('inline',getview('index_js',$this->data));
		$this->layout->theme('backend','index', $this->data);	
	}
	
	function show(){
		$this->rule->type('R');
		
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->layout->set_include('inline',getview('form_js'));
		
		$this->data['groups'] = $this->wd_db->select_data('select * from '.$this->groups.'');
		$this->data['user_group'] = $this->wd_db->select_data('select * from '.$this->users_groups.' where user_id='.$id.'');
		
		$this->data['list'] = $this->wd_db->get_data_row($this->table_users,array('id'=>$id));
		
		$this->layout->theme('backend','show', $this->data);
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
		
	function add(){
		$this->rule->type('C');
		
		//Run validate with js
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->layout->set_include('inline',getview('form_js'));
		
		$this->data['groups'] = $this->wd_db->select_data('select * from '.$this->groups.'');
		$this->layout->theme('backend','add', $this->data);	
	}
	
	function edit(){
		$this->rule->type('U');
		
		$this->data['rules'] = array(
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
		
		$this->load->library('urlcrypt');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->layout->set_include('inline',getview('form_js'));
		
		$this->data['groups'] = $this->wd_db->select_data('select * from '.$this->groups.'');
		$this->data['user_group'] = $this->wd_db->select_data('select * from '.$this->users_groups.' where user_id='.$id.'');
		
		$this->data['list'] = $this->wd_db->get_data_row($this->table_users,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('C');
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');
		
		$group_ids = $this->input->post('groups');
		
		$identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;
		
		$email    = strtolower($this->input->post('email'));
		$username = strtolower($this->input->post('username'));
		$identity = ($identity_column==='email') ? $email : $this->input->post('identity');
		$password = $this->input->post('password');
		
		$additional_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name'  => "",
			'company'    => "",
			'phone'      => $this->input->post('phone')
		);
		
		$this->ion_auth->register($identity, $password, $email,$username, $additional_data,$group_ids);
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		$this->rule->type('U');
		
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
		
		$group_ids = $this->input->post('groups');
		
		$this->wd_db->del_dml_where_in($this->users_groups,'user_id',$user->id);
		foreach($group_ids as $row){
			$data = array(
				"user_id" => $user->id,
				"group_id" => $row
			);

			$this->wd_db->add_dml_get_id($this->users_groups,$data);
			$this->session->set_flashdata('success_message', 'Record updated successfully');
		}
			
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
	}
	
	function delete_action(){
		$this->rule->type('D');
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_users,'id','first_name');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		$this->wd_db->del_dml_where_in($this->table_users,'id',$del_id);
		$this->wd_db->del_dml_where_in($this->users_groups,'user_id',$del_id);
		
		redirect(admin_dir().this_module());
	}

	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this->rule->type('R');
		
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'id'));
		$jsonArray = $this -> datatable -> datatableJson(array());
		$this -> output -> set_header("Pragma: no-cache");
        $this -> output -> set_header("Cache-Control: no-store, no-cache");
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}