<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends MY_backend {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		$this->load->model('m_index');
		
		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb/untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('System');
		$this->breadcrumb->add_crumb('Modules');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> System';
		$this->data['sub_primary_title'] = 'administrator setting';
		
		$this->data['sub_title'] = 'Modules';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_modules = $this->data['tables']['prefix'].'modules';
		$this->table_group_privileges = $this->data['tables']['prefix'].'group_privileges';
		$this->groups =  $this->data['tables']['prefix'].'groups';
		
		$this->validation_rule();
	}
	
	// {VIEW} //
	function index(){
		$this->rule->type('R');
		
		$this->layout->set_include_group('index');
		
		$this->data['no_delete'] = $this->wd_db->get_data($this->table_modules,array('no_delete'=>'1'));
		$this->data['table_module'] = $this->wd_db->get_data($this->table_modules,array('table_module <>'=>'null'));
		$this->layout->set_include('inline',getview('index_js',$this->data));
		$this->layout->theme('backend','index', $this->data);	
	}
	
	function show(){
		$this->rule->type('R');
		
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->data['modules'] = $this->wd_db->select_data('select * from '.$this->table_modules.' order by sort_order asc');
		$this->data['groups'] = $this->wd_db->select_data('select * from '.$this->groups.'');
		$this->data['list'] = $this->wd_db->get_data_row($this->table_modules,array('id'=>$id));
		
		$this->layout->theme('backend','show', $this->data);
	}
	
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
			array(
				 'field'   => 'title',
				 'label'   => 'Title',
				 'rules'   => 'required|min_length[2]'
			  ),
		   	array(
				 'field'   => 'url',
				 'label'   => 'URL',
				 'rules'   => 'required'
			  )
	   	);
		
		$this->data['rules_message'] = array(
                 'title'	=> array(
					 'required'	=> "Title is required",
					 'min_length'  => "Please enter more then 2 char"
				 ),
                 'url'		=> array(
					 'required'    => "URL is required"
				 )
        );	
	}
	
	function icon(){
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->theme('backend','icon', $this->data);	
	}
		
	function add(){
		$this->rule->type('C');
		
		//Run validate with js
		//$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->data['modules'] = $this->wd_db->select_data('select * from '.$this->table_modules.' order by sort_order asc');
		$this->data['groups'] = $this->wd_db->select_data('select * from '.$this->groups.'');
		$this->layout->theme('backend','add', $this->data);	
	}
	
	function edit(){
		$this->rule->type('U');
		
		$this->load->library('urlcrypt');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->set_include('css','AdminLTE/plugins/radiocheck/radiocheck.css');
		$this->data['modules'] = $this->wd_db->select_data('select * from '.$this->table_modules.' order by sort_order asc');
		$this->data['groups'] = $this->wd_db->select_data('select * from '.$this->groups.'');
		$this->data['list'] = $this->wd_db->get_data_row($this->table_modules,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('C');
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');
		
		$group_ids = $this->input->post('groups');
			
		
		$rule['a'] = bool_checkbox($this->input->post('a')); 
		$rule['c'] = bool_checkbox($this->input->post('c')); 
		$rule['r'] = bool_checkbox($this->input->post('r')); 
		$rule['u'] = bool_checkbox($this->input->post('u'));  
		$rule['d'] = bool_checkbox($this->input->post('d')); 
		$rule = $rule['a'].$rule['r'].$rule['c'].$rule['u'].$rule['d'];

		$data = array(
			'title' => $this->input->post('title'),
			'url' => $this->input->post('url'),
			'parent' => $this->input->post('parent'),
			'support' => $rule,
			'sort_order' => $this->input->post('position'),
		);
				
		$icon = $this->input->post('icon');
		if ($icon!='') $data['icon'] = $icon;

		$id = $this->wd_db->add_dml_get_id($this->table_modules,$data);
		if($id!=''){
			$this->wd_db->set_order($this->table_modules,$id,'sort_order',$this->input->post('position'));
			
			foreach($group_ids as $row){
				$data = array(
					"groups_id" => $row,
					"modules_id" => $id,
					"privilege"	=> "11111"
				);
				
				$this->wd_db->add_dml_get_id("wd_group_privileges",$data);
			}
			
			//$this->session->set_flashdata('success_message', 'New record created successfully');
		}
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		$this->rule->type('U');
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$rule['a'] = bool_checkbox($this->input->post('a')); 
		$rule['c'] = bool_checkbox($this->input->post('c')); 
		$rule['r'] = bool_checkbox($this->input->post('r')); 
		$rule['u'] = bool_checkbox($this->input->post('u'));  
		$rule['d'] = bool_checkbox($this->input->post('d')); 
		$rule = $rule['a'].$rule['r'].$rule['c'].$rule['u'].$rule['d'];
		$data = array(
			'title' => $this->input->post('title'),
			'icon' => $this->input->post('icon'),
			'url' => $this->input->post('url'),
			'parent' => $this->input->post('parent'),
			'support' => $rule,
			'sort_order' => $this->input->post('position')
		);
		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);
		
		$where = array(
			'id' => $id
		);
		
		if($this->wd_db->edit_dml($this->table_modules,$data,$where)){
			$this->wd_db->set_order($this->table_modules,$id,'sort_order',$this->input->post('position'));
			//$this->session->set_flashdata('success_message', 'Record updated successfully');
		}
		
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
	}
	
	function delete_action($db=''){
		$this->rule->type('D');
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_modules,'id','title','sort_order','',$db);
			return;
		}
		$del_id = $this->session->flashdata('del_id');
		if ($this->input->get('custom')=='all') {
			if (count($del_id>0)) {
				foreach ($del_id as $id_module) {
					$tabel = $this->wd_db->get_row($this->table_modules,array('id'=>$id_module),'table_module,url');
					if($tabel['table_module']) {
						$table_module = explode(',', $tabel['table_module']);
						foreach ($table_module as $tbl)	$this->db->query("DROP TABLE IF EXISTS ".$tbl);
					}
					if ($tabel['url']!='' && $tabel['url']!='#') {
						$dirPath = './application/modules/backend/'.$tabel['url'];
						foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirPath, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
							$path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname());
						}
						rmdir($dirPath);
					}
				}
			}	
		}

		$this->wd_db->del_dml_where_in($this->table_group_privileges,'modules_id',$del_id);
		$this->wd_db->del_dml_where_in($this->table_modules,'id',$del_id);

		
		redirect(admin_dir().this_module().'');
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this->rule->type('R');
		
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'id'));
		$jsonArray = $this -> datatable -> datatableJson(array());
		
		$data_tree = $this->m_index->get_array_module();
		//debug($data_tree);
		$index = 0;
		$sub = 0;
		$id_before = "0";
		
		$id = $this->session->userdata();
		$user_id = $id['user_id'];
		$super = $this->m_index->check_if_super($user_id);
		
		
		
		if(!$super){
			$jsonArray["data_mix"] = null;
			for($i=0;$i<count($jsonArray["data"]);$i++){
				if($jsonArray["data"][$i]["m"]["only_super"]!="1"){
					$jsonArray["data_mix"][$index] = $jsonArray["data"][$i]; 

					$jsonArray["data_mix"][$index]["number"] = $index+1;
					$jsonArray["data_mix"][$index]["m"] = $data_tree[$jsonArray["data_mix"][$index]["id"]];
					$jsonArray["data_mix"][$index]["m"]["icon"] = "<i class='".$jsonArray["data_mix"][$index]["m"]["icon"]."'><i>";
					$jsonArray["data_mix"][$index]["id"] = $data_tree[$jsonArray["data_mix"][$index]["id"]]["id"];
					$jsonArray["data_mix"][$index]["DT_RowId"] = $this->urlcrypt->encode($data_tree[$jsonArray["data_mix"][$index]["id"]]["id"]);
					$jsonArray["data_mix"][$index]["checkboxs"] = '<input class="wd_checkbox" id="dtcheckbox[]" type="checkbox" value="'.$this->urlcrypt->encode($data_tree[$jsonArray["data_mix"][$index]["id"]]["id"]).'" name="dtcheckbox[]">';

					$index++;
				}
			}
			$jsonArray["data"] = $jsonArray["data_mix"];
		}else{
			foreach($jsonArray["data"] as $jsonArray_row){
				$jsonArray["data"][$index]["m"] = $data_tree[$jsonArray["data"][$index]["m"]["id"]];
				$jsonArray["data"][$index]["m"]["icon"] = "<i class='".$jsonArray["data"][$index]["m"]["icon"]."'><i>";
				$jsonArray["data"][$index]["id"] = $data_tree[$jsonArray["data"][$index]["m"]["id"]]["id"];
				$jsonArray["data"][$index]["DT_RowId"] = $this->urlcrypt->encode($data_tree[$jsonArray["data"][$index]["m"]["id"]]["id"]);
				$jsonArray["data"][$index]["checkboxs"] = '<input class="wd_checkbox" id="dtcheckbox[]" type="checkbox" value="'.$this->urlcrypt->encode($data_tree[$jsonArray["data"][$index]["m"]["id"]]["id"]).'" name="dtcheckbox[]">';

				$index++;
			}
		}
		
		$this -> output -> set_header("Pragma: no-cache");
        $this -> output -> set_header("Cache-Control: no-store, no-cache");
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}