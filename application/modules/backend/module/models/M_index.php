<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_index extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->table_modules = $this->data['tables']['prefix'].'modules';
	}
	
	function get_child_by_parent_id($module_parent){
		$data = $this->db->query("select * from ".$this->table_modules." where parent='".$module_parent."' order by sort_order asc");
        $data = $data->result_array();
		return $data;
	}
	
	private $output_module = array();
	private $index = 0;
	private $level = 0;
	
	function generate_array_module($module_parent="0"){
		$module = $this->get_child_by_parent_id($module_parent);
		foreach($module as $module_row){
			
			$this->output_module[$module_row["id"]] = $module_row;
			
			$str_level = "";
			for($i=0;$i<$this->level;$i++){
				$str_level .= " <i class='fa fa-caret-right'></i> "; 
			}
			
			$this->output_module[$module_row["id"]]["title"] = $str_level.$module_row["title"];
			$this->index++;
			
			$module_sub = $this->get_child_by_parent_id($module_row["id"]);
			if(count($module_sub)>0){
				//print_r($module_sub);
				$this->level++;
				$this->generate_array_module($module_row["id"]);
				$this->level--;
			}
		}
	}
	
	function get_array_module(){
		$this->output_module = array();
		$this->level = 0;
		$this->index = 0;
		
		$this->generate_array_module();
		
		return $this->output_module;
	}
	
	public function check_if_super($id){

		$this->db->select('*');
		$this->db->from('wd_users_groups');
		$this->db->where('user_id',$id);
		$this->db->where('group_id', '1');

		$query =  $this->db->get()->num_rows();
		if($query>0){
			return true;
		}
		return false;
	}
}
