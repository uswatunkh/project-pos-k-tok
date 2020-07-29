<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_index extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_db_table(){
		$data = $this->db->query("SELECT DISTINCT TABLE_NAME 
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_SCHEMA='".$this->db->database."'");
        $data = $data->result_array();
		return $data;
	}
	
	function get_table_column($table){
		$data = $this->db->query("SHOW COLUMNS FROM $table");
        $data = $data->result_array();
		return $data;
	}
	
	function get_table_primary(){
		$data = $this->db->query("select distinct primary_table,primary_id,on_delete  from wd_data_relation");
        $data = $data->result_array();
		return $data;
	}
	
	function get_table_relation($primary_table){
		$data = $this->db->query("select * from wd_data_relation where primary_table='$primary_table'");
        $data = $data->result_array();
		return $data;
	}
}