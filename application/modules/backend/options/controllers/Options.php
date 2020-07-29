<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Options extends MY_backend
{
    function __construct()
    {
        parent::__construct();

		
        //library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Options');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Options';
		$this->data['sub_primary_title'] = '';
		
		$this->data['sub_title'] = 'Options';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_wd_options = 'wd_options'; 
			
		$this->validation_rule();
    }
	
	// {VIEW} //
	function index(){
		$this->rule->type('R');
	
		$this->layout->set_include_group('index');
		$this->data['no_delete'] = $this->wd_db->get_data($this->table_wd_options,array('no_delete'=>'1'));
		$this->layout->set_include('inline',getview('index_js',$this->data));
		$this->layout->theme('backend','index', $this->data);	
			
	}
	
	function show(){
		$this->rule->type('R');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));

		$this->data['list'] = $this->wd_db->get_data_row($this->table_wd_options,array('id'=>$id));
		
		$this->layout->theme('backend','show', $this->data);
	}
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
			//array('field'   => 'name', 'label' => 'Name','rules'   => 'required'),
			array('field'   => 'value', 'label' => 'Value','rules'   => 'required')
		);
		$this->data['rules_message'] = array();
	}
	
	function add(){
		$this->rule->type('C');
		//Run validate with js
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');

		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->theme('backend','add', $this->data);	
	}
	
	function edit(){
		$this->rule->type('U');
		
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$this->load->library('urlcrypt');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js')); 

		$this->data['list'] = $this->wd_db->get_data_row($this->table_wd_options,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('C');
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');

		$data = array(
			'name' => $this->input->post('name'),
			'value' => $this->input->post('value')
		);
		
		$this->wd_db->add_dml_get_id($this->table_wd_options,$data);
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		$this->rule->type('U');		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$old = $this->wd_db->get_data($this->table_wd_options,array('id' => $id)) ;

		if($this->input->post('name')=="password_email"){
			$data = array(
				'value' => $this->urlcrypt->encode($this->input->post('value'))
			);
		}else{
			$data = array(
				'value' => $this->input->post('value')
			);	
		}
		
		$where = array(
			'id' => $id
		);
		
		$this->wd_db->edit_dml($this->table_wd_options,$data,$where);
			
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));	
	}
	
	function delete_action(){
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_wd_options,'id','name');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		$this->wd_db->del_dml_where_in($this->table_wd_options,'id',$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'wd_options.id'));
		$jsonArray = $this -> datatable -> datatableJson(array());

		$index = 0;
		
		foreach($jsonArray["data"] as $jsonArray_row){
			$raw_data = strip_tags($jsonArray["data"][$index]["wd_options"]['value']);
			$value = substr($raw_data,0, 90);
			if(strlen($raw_data)>90){
				$value = $value."....";
			}
			
			$jsonArray["data"][$index]["wd_options"]['value'] = $value;
			$index++;
		}

		$this -> output -> set_header('Pragma: no-cache');
        $this -> output -> set_header('Cache-Control: no-store, no-cache');
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}




/* End of file Options.php */
/* Location: ./application/modules/options/controllers/Options.php */
/* Please DO NOT modify this information : */
/* Generated by IndonesiaIT Codeigniter CRUD Generator 2017-01-26 02:30:48 */
/* indonesiait.com */