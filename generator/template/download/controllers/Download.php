<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends MY_backend
{
    function __construct()
    {
        parent::__construct();

		
		$GLOBALS['folder_file'] = 'public/download_file/';			
        //library breadcrum/untuk navigasi					
		$this->allowed_types = array('pdf','zip','rar','doc','docx','xls','xlsx');
		$this->file_size = array(1,20480);
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Download');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Download';
		$this->data['sub_primary_title'] = '';
		
		$this->data['sub_title'] = 'Download';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_download = 'download'; 
			
		$this->validation_rule();
    }
	
	// {VIEW} //
	function index(){
		$this->rule->type('R');
	
		$this->layout->set_include_group('index');
		$this->layout->set_include('inline',getview('index_js',$this->data));
		$this->layout->theme('backend','index', $this->data);	
	}
	
	function show(){
		$this->rule->type('R');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->data['tb_wd_users'] = $this->wd_db->select_data('select id,username from wd_users');

		$this->data['list'] = $this->wd_db->get_data_row($this->table_download,array('id'=>$id));
		
		$this->layout->theme('backend','show', $this->data);
	}
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
			array('field'   => 'judul','label'   => 'Judul','rules'   => 'required'),
			array('field'   => 'deskripsi','label'   => 'Deskripsi','rules'   => 'required'),
		);
		$this->data['rules_message'] = array();
	}
	
	function add(){
		$this->rule->type('C');
		array_push($this->data['rules'], array('field'   => 'file','label'   => 'file','rules'   => 'required'));
		
		//Run validate with js
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		$this->data['tb_wd_users'] = $this->wd_db->select_data('select id,username from wd_users');

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
		$this->data['tb_wd_users'] = $this->wd_db->select_data('select id,username from wd_users');

		$this->data['list'] = $this->wd_db->get_data_row($this->table_download,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('C');

		if (isset($_FILES['file']['name']) && $_FILES['file']['name']!= '') {
			check_files('file','/add',$this->file_size,$this->allowed_types);
			$updata = file_upload($GLOBALS['folder_file'],'file');
			if ($updata['error']!='') {
				$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/add');
				exit();
			}
			$file = $updata['name'];
		}else{
			$file = '';
			$this->session->set_flashdata('validation_errors', "File required !");
			$this->session->set_flashdata('input_post', $this->input->post());
			redirect(admin_dir().this_module().'/add');
		}
					
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');

		$data = array(
			'judul' => $this->input->post('judul'),
			'deskripsi' => $this->input->post('deskripsi'),
			'file' => $file,
			'date' => date('Y-m-d'),
			'author' => $_SESSION['user_id']
		);
		
		$this->wd_db->add_dml_get_id($this->table_download,$data);
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		$this->rule->type('U');		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$old = $this->wd_db->get_data($this->table_download,array('id' => $id)) ;

		if (isset($_FILES['file']['name']) && $_FILES['file']['name']!= '') {
			check_files('file','/edit?id='.$this->input->post('id'),$this->file_size,$this->allowed_types);
			$updata = file_upload($GLOBALS['folder_file'],'file');
			if ($updata['error']!='') {
				$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/add');
				exit();
			}
			$file = $updata['name'];
			@unlink($GLOBALS['folder_file'].$old[0]['file']);						
		}else{
			$file = $old[0]['file'];
		}
			
		$data = array(
			'judul' => $this->input->post('judul'),
			'deskripsi' => $this->input->post('deskripsi'),
			'file' => $file,
			'date' => $this->input->post('date'),
			'author' => $this->input->post('author'),
			'downloader' => $this->input->post('downloader')
		);

		
		
		$where = array(
			'id' => $id
		);
		
		$this->wd_db->edit_dml($this->table_download,$data,$where);
			
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));	
	}
	
	function delete_action(){
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_download,'id','judul');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		foreach ($del_id as $id) {
			$old = $this->wd_db->get_data($this->table_download,array('id' => $id)) ;
			@unlink($GLOBALS['folder_file'].$old[0]['file']);
		}
		$this->wd_db->del_dml_where_in($this->table_download,'id',$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'download.id'));
		
		$jsonArray = $this -> datatable ->order_by('date', 'desc');
		$jsonArray = $this -> datatable -> datatableJson(array());


		foreach ($jsonArray['data'] as $index => $json) {
			$jsonArray['data'][$index]['download']['deskripsi']=substr($jsonArray['data'][$index]['download']['deskripsi'], 0,40);

			$data = $json['download']['file'];
			$size = FileSizeConvert("public/download_file/$data");
			$jsonArray['data'][$index]['download']['file']="<a title='$size' target='_blank' href='".base_url()."public/download_file/$data'>$data</a>";
			$jsonArray['data'][$index]['download']['date']=convertDate($jsonArray['data'][$index]['download']['date'], 'd m y');

		}

		$this -> output -> set_header('Pragma: no-cache');
        $this -> output -> set_header('Cache-Control: no-store, no-cache');
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}




/* End of file Download.php */
/* Location: ./application/modules/download/controllers/Download.php */
/* Please DO NOT modify this information : */
/* Generated by WD Codeigniter CRUD Generator 2016-11-19 05:50:58 */
/* indonesiait.com */