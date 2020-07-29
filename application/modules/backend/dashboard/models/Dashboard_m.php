<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_m extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * [where_superadmin description]
	 * @return [type] [description]
	 */
	public function where_superadmin(){

		$this->db->distinct();
		$this->db->select('user_id  , wd_users.username , wd_users.last_login ');
		$this->db->from('wd_users_groups');
		$this->db->join('wd_users','wd_users_groups.user_id=wd_users.id');
		$this->db->join('wd_groups','wd_users_groups.group_id=wd_groups.id');
		
		$this->db->order_by('wd_users.last_login','desc');
		return $query = $this->db->get()->result_array();
	}

	/**
	 * [not_superadmin description]
	 * @return [type] [description]
	 */
	public function where_not_superadmin(){

		$this->db->distinct();
		$this->db->select('user_id  , wd_users.username , wd_users.last_login ');
		$this->db->from('wd_users_groups');
		$this->db->join('wd_users','wd_users_groups.user_id=wd_users.id');
		$this->db->join('wd_groups','wd_users_groups.group_id=wd_groups.id');
		$this->db->where('wd_users_groups.group_id !=','1');
		
		$this->db->order_by('wd_users.last_login','desc');
		return $query = $this->db->get()->result_array();
	}

	/**
	 * [role cek superadmin group.id = 1 ]
	 * @param  string $id [description]
	 * @return [type]     [description]
	 */
	public function role($id){

		$this->db->select('*');
		$this->db->from('wd_users_groups');
		$this->db->where('user_id',$id);
		$this->db->where('group_id', '1');

		return $query =  $this->db->get()->num_rows();
	}
	
	public function getRecord(){
		$strQuery = 
			"SELECT SUM(TABLE_ROWS) as RECORD_IN_DB
			 FROM INFORMATION_SCHEMA.TABLES 
			 WHERE TABLE_SCHEMA = '".$this->db->database."' and TABLE_NAME not in('wd_users_groups','wd_login_attempts','wd_options','wd_group_privileges','wd_data_relation','polling_cache','polling_det','online_users')";
		
		$result = $this->db->query($strQuery)->row();
        return $result->RECORD_IN_DB;
	}
	
	public function getRecordPerTable(){
		$strQuery = 
			"SELECT TABLE_NAME,TABLE_ROWS 
			 FROM INFORMATION_SCHEMA.TABLES 
			 WHERE TABLE_SCHEMA = '".$this->db->database."' and TABLE_NAME not in('wd_users_groups','wd_login_attempts','wd_options','wd_group_privileges','wd_data_relation','polling_cache','polling_det','online_users')";
		
		$result = $this->db->query($strQuery)->result_array();
        return $result;
	}


}
