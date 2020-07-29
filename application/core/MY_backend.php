<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_backend extends CI_Controller {
	public $data;
	private $dependenci_table;
	private $relation_status;
	private $delete_tree;
	
	function __construct(){
		parent::__construct();
		$this->lang->load('auth');
		$this->load->library('wd_validation');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->library('urlcrypt');
		
		$this->ion_auth_setup();
		$this->data['tables'] = $this->config->item('tables','ion_auth');
		
		//default privilege
		$this->data['privilege'] = array('A' => 1, 'R' => 1,'C' => 1, 'U' => 1, 'D' => 1);

		$this->online_users();
		
	}

	public function online_users(){
	
		$data =  array(
			'session' => session_id(),
			'time' => time()
			);

		$time_check = $data['time']-100; //set time 5 minute
		
		$this->query = $this->db->select('*')->from('online_users')->where('session', $data['session'])->get()->num_rows();

		if($this->query === 0){

			$this->db->insert('online_users',$data);

		}else{

			$this->db->set('time', $data['time']);
			$this->db->where('session', $data['session']);
			$this->db->update('online_users');

		}
		
		$this->db->select('*')->from('online_users')->get()->num_rows();
		//if over 10 minutes delete session
		$this->db->where('time < ', $time_check );
		$this->db->delete('online_users');	

	}
	
	function ion_auth_setup(){
		if (!$this->ion_auth->logged_in()){
			$this->data['user'] ='';
			$this->data['user_groups']='';
			
			if($this->uri->segment(2)!="auth"){
				redirect(admin_dir().'auth/login', 'refresh');
			}
		}else{
			$this->data['user'] = $this->ion_auth->user()->row();
			$this->data['user_groups'] = $this->ion_auth->get_users_groups()->result_array(); 
		}
	}
	
	public function ci_validation(){
		if(count($this->data['rules'])==0){
			return TRUE;
		}
		
		$this->form_validation->set_rules($this->data['rules']); 
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('validation_errors', validation_errors());
			$this->session->set_flashdata('input_post', $this->input->post());
			return FALSE;
		}
		
		return TRUE;
	}
	
	public function confirm_delete($table,	$id,	$field_show,	$order='',	$from='', $custom=''){
		$del_id_encode = ($from=='') ? $this->input->post('checkbox') : $from ;
		
		$dep = null;
		$rel = null;
		$del_ids = null;
		$del_tree = null;
		
		if($del_id_encode!=null){
			$this->load->library('urlcrypt');
			
			
			foreach($del_id_encode as $row){
				$ids = $this->urlcrypt->decode($row);
				$del_id[] = $ids;
				
				$where = array("primary_table"=>$table);
				$relation = $this->wd_db->get_data("wd_data_relation",$where);

				$this->dependenci_table = null;
				$this->relation_status = null;
				$this->delete_tree = null;
				
				$this->check_detele($relation,$ids);
				
				$dep[] = $this->dependenci_table;
				$rel[] = $this->relation_status;
				
				
				if($this->relation_status!="restrict"){
					$del_ids[] = $ids;
					$del_tree[] = $this->delete_tree;
				}
			}
		}
		else{
			$del_id = null;
		}
		
		
		$this->data['delete_row'] = $this->wd_db->get_data_delete_confirmation($table,$id,$del_id,$order);
		$this->data['field_show'] = $field_show;
		$this->data['table']      = $table;
		$this->data["custom"]     = $custom;
		$this->data["dependenci_table"]     = $dep;
		$this->data["relation_status"]     = $rel;
		$this->session->set_flashdata('del_id', $del_ids);
		$this->session->set_flashdata('del_tree', $del_tree);
		$this->load->view('general_view/delete_modal', $this->data);
	}
	

	public function check_detele($relation,$id){
		foreach($relation as $relation_rows){
			$where = array($relation_rows['relation_id']=>$id);
			$relation_1 = $this->wd_db->get_data($relation_rows['relation_table'],$where);
		
			if(count($relation_1)>0){
				$this->dependenci_table["relation"][] = $relation_rows['relation_table'];
				$this->dependenci_table["on_delete"][] = $relation_rows['on_delete'];
				
				if($this->relation_status!="restrict"){
					$this->relation_status = $relation_rows['on_delete'];	
				}
				
				foreach ($relation_1 as $key => $value){
					$this->delete_tree[] = array(
						"table"=>$relation_rows['relation_table'],
						"field"=>$relation_rows['relation_id'],
						"value"=>$value[$relation_rows['relation_id']]
					);
					
					$where_2 = array("primary_table"=>$relation_rows['relation_table']);
					$relation_2 = $this->wd_db->get_data("wd_data_relation",$where_2);
					
					foreach ($value as $key => $e){
						$key2 = $key; break;
					}
					$this->check_detele($relation_2,$value[$key2]);
				}
				
			}
		}
	}

}

?>