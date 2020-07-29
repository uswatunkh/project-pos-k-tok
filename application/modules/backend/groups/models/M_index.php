<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_index extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_module(){
		$strQuery = "select * from wd_modules order by sort_order";
		$data = $this->db->query($strQuery);
        return $data->result_array();
	}
}
