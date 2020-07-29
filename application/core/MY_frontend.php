<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_frontend extends MX_Controller {
	
	public $data;
	function __construct(){
		parent::__construct();
		$this->load->helper('dateid');
		$this->load->library('form_validation');
		if( !$this->session->userdata('my_id')) redirect('auth','refresh');
		$this->url_module = base_url().$this->uri->segment(1);
		$this->user_data = (array)$this->session->userdata('my_id');
		$this->crumb('Home',base_url('dashboard'));
		$this->crumb(ucwords(\str_replace('_', ' ', $this->uri->segment(1))),base_url($this->uri->segment(1)));
	}


	public function view($data = NULL,$form_page=false){
		$data['form_page'] = $form_page;
		if(!isset($data['header_mini'])) $data['header_mini'] = $this->uri->segment(2);	
		$data['a_user'] = $this->user_data;
		$this->load->view('view', $data);
	}

	function crumb($name,$url=false){ $this->breadcrumb->add_crumb($name,$url);	}

	function alert($tipe,$val,$rule=''){
		$e = '<div class="alert alert-'.$tipe.'"><button type="button" class="close" data-dismiss="alert">×</button>'.$val.'</div>';
		$this->session->set_flashdata('alert', $e);
		if($rule) $rule = '/'.$rule;
		redirect($this->uri->segment(1).$rule,'refresh');
	}
	
	public function ci_validation(){
		$this->form_validation->set_rules($this->rules); 
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('post', $this->input->post());
			return FALSE;
		}else{ 
			return true; 
		}
	}

	function bulk_delete($table,$field,$return=false){
		$del_id = $this->input->post('item');
		if(count($del_id)<1) die(json_encode(array('status' => '[Hacked] !', 'ket' => 'Silahkan pilih yang mau dihapus')));
		foreach ($del_id as $id => $nama)  {
			$id=$this->urlcrypt->decode($id);
			$in[]=$id;
		}
       	if($return){
       		return $in;
       	}else{
			$this-> multi_del($table,$field,$in);
       		echo json_encode(array('status' => 'Berhasil !', 'ket' => count($in).' item[s] Berhasil di hapus'));
       	} 
	}

	function multi_del($table,$field,$in){
	   $this->db->where_in($field, $in);
       return $this->db->delete($table);
	}

}
?>