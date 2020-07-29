<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_backend
{
    function __construct()
    {
        parent::__construct();

		
		$GLOBALS['folder_file'] = 'public/blog_file/';					
		$this->allowed_types = array('jpg','jpeg','png');
		$this->file_size = array(1,7000);
		$GLOBALS['thumb_file'] = '520,520';			
        //library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		$this->load->model('m_index');
		
		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Blog');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Blog';
		$this->data['sub_primary_title'] = '';
		
		$this->data['sub_title'] = 'Blog';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_blog = 'blog';
		$this->data["slider_number"] = 4;
		
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

		$this->data['list'] = $this->wd_db->get_data_row($this->table_blog,array('id'=>$id));
		$user_name = $this->wd_db->get_data('wd_users',array('id' => $this->data['list']['user']));
		$this->data['list']['user'] = $user_name[0]['username'] ;
		
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

		$this->data['list'] = $this->wd_db->get_data_row($this->table_blog,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //

	function save_action(){

		$this->rule->type('C');

		if (isset($_FILES['file']['name']) && $_FILES['file']['name']!= '') {
			check_files('file','/add',$this->file_size,$this->allowed_types);
			$updata = file_upload($GLOBALS['folder_file'],'file',$GLOBALS['thumb_file'],"crop");
			if ($updata['error']==1) {
				$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/add');
				exit();
			}
			$file = $updata['name'];
		}else{
			$file = '';
		}
			
		$tag ='';
		$sparate ='';	
		if (isset($_POST['tag'])) {			
			foreach ($_POST['tag'] as $key => $value) {
				if ($key>0) {	$sparate =',';		}
				$tag .= $sparate.$value;
			}
			
		}	
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');

		$data = array(
			'judul' => $this->input->post('judul'),
			'deskripsi' => $this->input->post('deskripsi'),
			'file' => $file,
			'user_view' => '',	
			'tgl' => $this->input->post('tgl'),		
			'user' => $_SESSION['user_id'],
			'tag' =>$tag
		);
		
		$this->wd_db->add_dml_get_id($this->table_blog,$data);
		
		redirect(admin_dir().this_module().'/add');
	}

	function on_top(){
		$this->rule->type('U');		
		$id = $this->input->get('id');
		$id = $this->urlcrypt->decode($id);
		
		$top_slider = $this->m_index->get_top() + 1;
		
		$data = array(	'slider_priority' => $top_slider);
		$where = array(	'id' => $id			);
		$this->wd_db->edit_dml($this->table_blog,$data,$where);
		
		$slider_number = $this->data["slider_number"];
		$this->m_index->clear_last_slider_priority($slider_number);
		
		redirect(admin_dir().this_module());	
		
	}
	
	function update_action(){
		$this->rule->type('U');		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$old = $this->wd_db->get_data($this->table_blog,array('id' => $id)) ;

		if (isset($_FILES['file']['name']) && $_FILES['file']['name']!= '') {
			check_files('file','/edit?id='.$this->input->post('id'),$this->file_size,$this->allowed_types);
			$updata = file_upload($GLOBALS['folder_file'],'file',$GLOBALS['thumb_file'],"crop");
			if ($updata['error']==1) {
				$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
				exit();
			}
			$file = $updata['name'];
			@unlink($GLOBALS['folder_file'].$old[0]['file']);
			@unlink($GLOBALS['folder_file'].'thumb/crop_'.$old[0]['file']);	
		}else{
			$file = $old[0]['file'];
		}
			
		$tag ='';
		$sparate ='';	
		if (isset($_POST['tag'])) {			
			foreach ($_POST['tag'] as $key => $value) {
				if ($key>0) {	$sparate =',';		}
				$tag .= $sparate.$value;
			}
			echo $tag;
		}
		
		$data = array(
			'judul' => $this->input->post('judul'),
			'deskripsi' => $this->input->post('deskripsi'),
			'tgl' => $this->input->post('tgl'),		
			'file' => $file,
			'tag' => $tag
		);

		
		
		$where = array(
			'id' => $id
		);
		
		$this->wd_db->edit_dml($this->table_blog,$data,$where);
			
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));	
	}
	
	function delete_action(){
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_blog,'id','judul');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		foreach ($del_id as $id) {
			$old = $this->wd_db->get_data($this->table_blog,array('id' => $id)) ;
			@unlink($GLOBALS['folder_file'].$old[0]['file']);
			@unlink($GLOBALS['folder_file'].'thumb/crop_'.$old[0]['file']);
		}
		$this->wd_db->del_dml_where_in($this->table_blog,'id',$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {

		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'blog.id'));
		$jsonArray = $this -> datatable ->order_by('slider_priority,tgl', 'desc');
		$jsonArray = $this -> datatable -> datatableJson(array());

		$list_tag[0] = array('1','satu');
		$list_tag[1] = array('2','dua');


		foreach ($jsonArray['data'] as $index => $json) {
			// $jsonArray['data'][$index]['blog']['deskripsi']=substr($jsonArray['data'][$index]['blog']['deskripsi'], 0,40);

			$data = $json['blog']['file'];
			$size = FileSizeConvert("public/blog_file/$data");
			
			if ($jsonArray['data'][$index]['blog']['file']!="") $jsonArray['data'][$index]['blog']['file']="<a title='$size' target='_blank' href='".base_url()."public/blog_file/$data'>Open</a>";

			// $jsonArray['data'][$index]['blog']['tag'] = substr($jsonArray['data'][$index]['blog']['tag'], 0,40);
			$jsonArray['data'][$index]['blog']['tgl'] = convertDate($jsonArray['data'][$index]['blog']['tgl'],"d m y");
			
			if($index<4){
				$jsonArray['data'][$index]['blog']['judul'] = "<span class='badge bg-yellow'><i class='fa fa-play-circle-o'></i> Slider Content</span> ".$jsonArray['data'][$index]['blog']['judul'];
			}
		
		}


		$this -> output -> set_header('Pragma: no-cache');
        $this -> output -> set_header('Cache-Control: no-store, no-cache');
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}




/* End of file Blog.php */
/* Location: ./application/modules/blog/controllers/Blog.php */
/* Please DO NOT modify this information : */
/* Generated by WD Codeigniter CRUD Generator 2016-08-13 10:10:58 */
/* indonesiait.com */
