<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wd_db extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function add_dml($table,$data){
        if($this->db->insert($table, $data)) return true;
        else return false;
    }
	
	function add_dml_get_id($table,$data){
	   	$this->db->insert($table, $data);
	   	$insert_id = $this->db->insert_id();
		$this->session->set_flashdata('success_message', 'New record created successfully');
		
	   	return $insert_id;
	}
    
    function edit_dml($table,$data,$field=array()){
        $this->db->where($field);
        $this->db->update($table, $data);
		$this->session->set_flashdata('success_message', 'Record updated successfully');
		return true; 
    }
    
    function del_dml($table,$field=array()){
        $this->db->where($field);
        $this->db->delete($table);
        return true;
    }
	
	function del_dml_where_in($table,$field,$in=array()){
	   if($in==null)
			return true;
		 
		$del_tree = $this->session->flashdata('del_tree');
		if(count($del_tree)>0){
			foreach($del_tree as $del_tree_rows){
				foreach($del_tree_rows as $del_tree_rows_detail){
					$field_delete_tree = array(
						$del_tree_rows_detail["field"] => $del_tree_rows_detail["value"]
					);
					$this->db->where($field_delete_tree);
					$this->db->delete($del_tree_rows_detail["table"]);
				}
			}
		}
		 
	   $this->db->where_in($field, $in);
       $this->db->delete($table);
	   $this->session->set_flashdata('success_message', count($in).' Record[s] deleted successfully');
       return true;
    }
	
	
	function get_data($table,$where=array(),$limit='',$start='') {
		if (count($where)>0) $this->db->where($where);       	
       	if ($limit!='') {       		
	       	if ($start=='') $this->db->limit($limit);
	       	else $this->db->limit($limit,$start);
       	}
       	$q = $this->db->get($table);
        return $q -> result_array();
    }
	
	function get_data_delete_confirmation($table,$field,$in=array(),$order='') {
        if(count($in)>0){
			$this->db->where_in($field, $in);
			if($order!=''){
				$this->db->order_by($order, "asc"); 
			}
			$query = $this->db->get($table);
		}
        else
        	return array();
        return $query -> result_array();
    }
	
	function get_data_row($table,$filed_array=array()) {
        if(count($filed_array)>0)
        	$query = $this->db->get_where($table, $filed_array);
        else
        	$query = $this->db->get($table);
		
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = '';
		}
		return $result;
    }

    function get_row($table,$filed_array=array(),$select='*') {
		$this->db->select($select);
		$this->db->from($table);
        if(count($filed_array)>0) $this->db->where($filed_array);        
        $query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = '';
		}
		return $result;
    }
	

		
// CONTOH $q = $this->wd_db->get_join('wd_group_privileges','wd_groups', array('name','description','id AS id_groups'),'wd_group_privileges.groups_id=wd_groups.id',3,3,array('groups_id'=>1));
	public function get_join($table, $tableJoin, $join_select=array(), $join_on, $limit='', $start='',$where=array()){		
		$select_join='';
		foreach ($join_select as $k => $val) {
			if ($k>0) $select_join .= ',';
			$select_join .= $tableJoin.".$val ";
		}
		
		if (count($where)>0) $this->db->where($where);
		$this->db->select($table.'.*', FALSE);
		$this->db->select($select_join, FALSE);
		$this->db->from($table);
		$this->db->join($tableJoin, $join_on);	
		if ($limit!='') {
			if ($start=='') {
	       		$this->db->limit($limit);
	       	}else{
	       		$this->db->limit($limit,$start);
	       	}
		}

	    $q = $this->db->get();
    	return $q->result_array();
	}

    function get_count ($table,$where=array()){
		if (count($where)>0) $this->db->where($where);
    	$q = $this->db->get($table);
    	return $q->num_rows();
    }
    function get_distinct($table,$value){
		$this->db->distinct();
		$this->db->select($value);
		$q = $this->db->get($table);
    	return $q->result_array();
    }

	function get_data_query($table,$filed_array=array()) {
        if(count($filed_array)>0)
        $query = $this->db->get_where($table, $filed_array);
        else
        $query = $this->db->get($table);
        return $query;
    }
    
    function select_data($strQuery=''){
        $data = $this->db->query($strQuery);
        return $data->result_array();
    }

	function set_order($table,$primary_id,$order_column_name,$row_index_destination){
		$old_data = $this->select_data('select * from '.$table.' where '.$order_column_name.'>'.$row_index_destination.'');
		
		foreach($old_data as $row){
			$this->db->where(array('id'=>$row['id']));
        	$this->db->update($table, array($order_column_name=>$row[$order_column_name]+1));
		}
		
		$field = array(
			'id' => $primary_id
		);
		
		$data = array(
			$order_column_name => $row_index_destination+1
		);
		
		$this->db->where($field);
        $this->db->update($table, $data);
		
		return TRUE;
	}
}
