<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends MY_backend {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		$this->load->library('wd_tree');
		$this->load->model('m_index');
		
		//breadcrumb/untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('System');
		$this->breadcrumb->add_crumb('Users');
		$this->breadcrumb->add_crumb('Groups');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> System';
		$this->data['sub_primary_title'] = 'administrator setting';
		
		$this->data['sub_title'] = 'Groups';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_modules = $this->data['tables']['prefix'].'modules'; 
		$this->table_groups = $this->data['tables']['prefix'].'groups'; 
		$this->table_group_privileges = $this->data['tables']['prefix'].'group_privileges';
			
		$this->validation_rule();
	}
	
	// {VIEW} //
	function index(){
		$this->rule->type('R');
		
		$this->layout->set_include_group('index');
		$this->data['no_delete'] = $this->wd_db->get_data($this->table_groups,array('no_delete'=>'1'));
		$this->layout->set_include('inline',getview('index_js',$this->data));
		$this->layout->theme('backend','index', $this->data);	
	}
	
	function show(){
		$this->rule->type('R');
		
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$module = $this->m_index->get_module();
		$this->data['module'] = $this->wd_tree->buildTree($module);
		$this->data['module'] = $this->wd_tree->buildArray($this->data['module'],"&nbsp;&nbsp;&nbsp;");
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->layout->set_include('inline',getview('form_js'));
		$this->data['list'] = $this->wd_db->get_data_row($this->table_groups,array('id'=>$id));
		$this->data['groups_privilage'] = $this->wd_db->get_data($this->table_group_privileges,array('groups_id'=>$id));
		
		$this->layout->theme('backend','show', $this->data);
	}
	
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
			array(
				 'field'   => 'group_name',
				 'label'   => 'Group Name',
				 'rules'   => 'required|min_length[2]'
			  )
	   	);
		
		$this->data['rules_message'] = array();
	}
		
	function add(){
		$this->rule->type('C');
		
		//Run validate with js
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$module = $this->m_index->get_module();
		$this->data['module'] = $this->wd_tree->buildTree($module);
		
		$this->data['module'] = $this->wd_tree->buildArray($this->data['module'],"&nbsp;&nbsp;&nbsp;");
		$this->layout->set_include_group('form');
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->theme('backend','add', $this->data);	
	}
	
	function edit(){
		$this->rule->type('U');
		
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$this->load->library('urlcrypt');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$module = $this->m_index->get_module();
		$this->data['module'] = $this->wd_tree->buildTree($module);
		$this->data['module'] = $this->wd_tree->buildArray($this->data['module'],"&nbsp;&nbsp;&nbsp;");
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->layout->set_include('inline',getview('form_js'));
		
		$this->data['no_delete'] = $this->wd_db->get_data($this->table_modules,array('no_delete'=>'1'));
		$this->data['list'] = $this->wd_db->get_data_row($this->table_groups,array('id'=>$id));
		$this->data['groups_privilage'] = $this->wd_db->get_data($this->table_group_privileges,array('groups_id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('C');
		
		$is_module = $this->input->post('is_module');
		$roles = $this->input->post('roles');
		$a = $this->input->post('admin');
		$c = $this->input->post('create');
		$r = $this->input->post('read');
		$u = $this->input->post('update');
		$d = $this->input->post('delete');

		if ($roles > 0) {
			foreach ($roles as $key => $value) {
				$roles_rules[$key] = array('is_module'=>$is_module[$key],'module_id' => $value,  'a' => $a[$key], 'c' => $c[$key], 'r' => $r[$key], 'd' => $d[$key], 'u' => $u[$key]);
			}
		}
		
		$group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
		
		$this->wd_db->del_dml_where_in($this->table_group_privileges,'groups_id',$group_id);
		
		if (isset($roles_rules) && !empty($roles_rules)) {
			
			foreach($roles_rules as $row){
				$privilege = "";
				if($row['is_module']=="1"){
					$privilege = $row['a'].$row['r'].$row['c'].$row['u'].$row['d'];
				}else{
					$privilege = $row['a']."1000";
				}
				
				$data = array(
					"groups_id" => $group_id,
					"modules_id" => $row['module_id'],
					"privilege" =>$privilege
				);
				
				$this->wd_db->add_dml_get_id($this->table_group_privileges,$data);
			}
		}
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		$this->rule->type('U');
		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);
		
		$is_module = $this->input->post('is_module');
		$roles = $this->input->post('roles');
		$a = $this->input->post('admin');
		$c = $this->input->post('create');
		$r = $this->input->post('read');
		$u = $this->input->post('update');
		$d = $this->input->post('delete');

		$roles_rules = array();
		if ($roles > 0) {
			foreach ($roles as $key => $value) {
				$roles_rules[$key] = array('is_module'=>$is_module[$key],'module_id' => $value,  'a' => $a[$key], 'c' => $c[$key], 'r' => $r[$key], 'd' => $d[$key], 'u' => $u[$key]);
			}
		}
		
		$this->ion_auth->update_group($id, $this->input->post('group_name'), $this->input->post('description'));
		$group_id = $id;
		
		$this->wd_db->del_dml_where_in($this->table_group_privileges,'groups_id',$group_id);
		
		if (isset($roles_rules) && !empty($roles_rules)) {
			foreach($roles_rules as $row){
				$privilege = "";
				if($row['is_module']=="1"){
					$privilege = $row['a'].$row['r'].$row['c'].$row['u'].$row['d'];
				}else{
					$privilege = $row['a']."1000";
				}
				
				$data = array(
					"groups_id" => $group_id,
					"modules_id" => $row['module_id'],
					"privilege" =>$privilege
				);
				
				$this->wd_db->add_dml_get_id($this->table_group_privileges,$data);
			}
		}
		
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
	}
	
	function delete_action(){
		$this->rule->type('D');
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_groups,'id','name');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		$this->wd_db->del_dml_where_in($this->table_groups,'id',$del_id);
		$this->wd_db->del_dml_where_in($this->table_group_privileges,'groups_id',$del_id);
		
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