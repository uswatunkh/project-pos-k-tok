<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relation extends MY_backend {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('m_index');
		$this->load->library(array('ion_auth','form_validation'));
		$this->lang->load('auth');
		
		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->layout->set_title("Data Relation");
		
		$this->table_data_relation = $this->data['tables']['prefix'].'data_relation';
	}
	
	public function index()
	{	
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Data Relation');
		
		$this->data['primary_title'] = '<i class="fa fa-gear"></i> Relation';
		$this->data['sub_primary_title'] = 'of data';
		
		$this->data['tables'] = $this->m_index->get_db_table();
		$this->data['table_primary'] = $this->m_index->get_table_primary();
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		
		$this->layout->theme('backend','v_relation',$this->data);
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('A');
		
		$primary_table = $this->input->post('primary_table');
		$primary_id = $this->input->post('primary_id');
		$relation_table = $this->input->post('relation_table');
		$relation_id = $this->input->post('relation_id');
		$on_delete = "restrict";
		
		$where = array("primary_table"=>$primary_table);
		$data_relation = $this->wd_db->get_data($this->table_data_relation,$where);
		
		if(count($data_relation)>0){
			$on_delete = $data_relation[0]["on_delete"];
		}
		
		$data = array(
			'on_delete' => $on_delete,
			'primary_table' => $primary_table,
			'primary_id' => $primary_id,
			'relation_table' => $relation_table,
			'relation_id' => $relation_id
		);
		
		$this->wd_db->add_dml_get_id($this->table_data_relation,$data);
		
		redirect(admin_dir().this_module().'/');
	}
	
	function update_action(){
		$this->rule->type('A');		
		$primary_table = $this->input->get('primary_table');
		$on_delete = $this->input->get('on_delete');

		$data = array(
			'on_delete' => $on_delete
		);
		
		$where = array(
			'primary_table' => $primary_table
		);
		
		$this->wd_db->edit_dml($this->table_data_relation,$data,$where);
			
		redirect(admin_dir().this_module());	
	}
	
	function delete_action(){
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_data_relation,'id','relation_table');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		$this->wd_db->del_dml_where_in($this->table_data_relation,'id',$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	public function get_column(){
		$table = $_GET['table'];
		$data_column = $this->m_index->get_table_column($table);
		$select = " selected ";
		foreach($data_column as $data_column_rows){
			echo "<option value='".$data_column_rows['Field']."' $select>".$data_column_rows['Field']."</option>";
			$select = "";
		}
	}
}
