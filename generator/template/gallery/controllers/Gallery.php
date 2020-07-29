<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MY_backend
{
    function __construct()
    {
        parent::__construct();
		
		$GLOBALS['thumb_file'] = '400,400';						
		$this->allowed_types = array('jpg','jpeg','png');
		$this->file_size = array(1,15524);		
        //library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Gallery');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Gallery';
		
		$this->data['sub_title'] = 'Gallery';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_gallery = 'gallery'; 
		$this->data['sub_primary_title'] = "";
		
    }
	
	function drop()	{
		$this->layout->set_include_group('confirm');
		$this->layout->set_include('inline',getview('dropzone_js'));
		$this->layout->theme('backend','dropzone', $this->data);
	}

	function index(){
		$this->rule->type('R');
		if ($this->uri->segment(4)=="datatable") {
			$this->layout->set_include_group('index');
			$this->layout->set_include('inline',getview('index_js',$this->data));
			$this->layout->theme('backend','index', $this->data);
		}else{
			$this->layout->set_include('inline',getview('gallery_js'));
			$this->data['album'] = $this->db->query("SELECT DISTINCT album FROM gallery")-> result_array();
			$this->layout->theme('backend','gallery', $this->data);
		}
	}

	function album(){
		$album = $this->uri->segment(4);
		if ($album=="root_folder") $album="";
		$this->data['album']  = $this->wd_db->get_data($this->table_gallery,array('album' => $album)) ;
		$this->layout->set_include('inline',getview('superbox_js.php'));
		$this->layout->set_include_group('confirm');
		$this->layout->theme('backend','gallery', $this->data);
	}

	function add(){
		$this->rule->type('C');
		$this->layout->set_include('inline',getview('dropzone_js'));		
		$this->layout->theme('backend','dropzone', $this->data);	
	}
	
	function edit(){
		$this->rule->type('U');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js')); 
		$this->data['tb_wd_users'] = $this->wd_db->select_data('select id,username from wd_users');
		$this->data['list'] = $this->wd_db->get_data_row($this->table_gallery,array('id'=>$id));
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	function save_action(){
		$this->rule->type('C');
		$album = strtolower($this->uri->segment(4));
		$album = str_replace("%20", "_", $album);
		if ($album=="root_folder") $album="";
		$label = "";
		$album_dir = "public/gallery/".$album;
		$old = $this->wd_db->get_data($this->table_gallery,array('album' => $album)) ;
		$count_album = count($old);
		if (isset($_FILES['file']['name']) && $_FILES['file']['name']!= '') {
			if ($count_album<1) {
				createDir($album_dir);
			}

			check_files('file','',$this->file_size,$this->allowed_types);
			$updata = file_upload($album_dir,'file',$GLOBALS['thumb_file'],"all");
			if ($updata['error']!="") {
				echo "error";exit();
			}
			$file = $updata['name'];
			if ($label == "") {				
				$extension = strrchr($file, ".");
				$label = str_replace($extension, "", $file);
			}
		}else{
			echo "upload error";exit;
		}
		
		$data = array(
			'file' => $file,
			'label' => $label,
			'album' => $album,
			'visible' => 1,
			'uploader' => $_SESSION['user_id']
		);
		
		$this->wd_db->add_dml($this->table_gallery,$data);
		
		
	}
	
	function update_action(){
		$this->rule->type('U');		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$old = $this->wd_db->get_data($this->table_gallery,array('id' => $id)) ;

		if (isset($_FILES['file']['name']) && $_FILES['file']['name']!= '') {
			check_files('file','/edit?id='.$this->input->post('id'),$this->file_size,$this->allowed_types);
			$album=$old[0]['album'];
			if ($album!="") {
				$album = "/".$album;
			}
			$album_dir = "public/gallery$album/";
			$updata =file_upload($album_dir,'file',$GLOBALS['thumb_file'],'all');
			if ($updata['error']==1) {
				$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/add');
				exit();
			}
			$file = $updata['name'];			
			
			@unlink("public/gallery$album/".$old[0]['file']);
			@unlink("public/gallery$album/thumb/thumb_".$old[0]['file']);
			@unlink("public/gallery$album/thumb/crop_".$old[0]['file']);
		}else{
			$file = $old[0]['file'];
		}
			
		$data = array(
			'file' => $file,
			'label' => $this->input->post('label'),
			'visible' => $this->input->post('visible'),
		);

		
		
		$where = array(
			'id' => $id
		);
		
		$this->wd_db->edit_dml($this->table_gallery,$data,$where);
			
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));	
	}
	
	function delete_action(){
		$url ='';
		$id = '';
		if (isset($_GET['id'])) {			
	        $url = $this->input->get('url');
			$id[]= $this->input->get('id');
		}

        if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_gallery,'id','file', '', $id, $url );
			return;
		}

		$del_id = $this->session->flashdata('del_id');
		foreach ($del_id as $id) {
			$old = $this->wd_db->get_data($this->table_gallery,array('id' => $id)) ;
			$album=$old[0]['album'];
			if ($album!="") {
				$album = "/".$album;
			}
			@unlink("public/gallery$album/".$old[0]['file']);
			@unlink("public/gallery$album/thumb/thumb_".$old[0]['file']);
			@unlink("public/gallery$album/thumb/crop_".$old[0]['file']);
		}

		$this->wd_db->del_dml_where_in($this->table_gallery,'id',$del_id);		
		redirect(admin_dir().this_module().$this->input->get('custom'));

	}	
	
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'gallery.id'));
		$jsonArray = $this -> datatable -> datatableJson(array());

		$list_visible[0] = array('0','No');
		$list_visible[1] = array('1','Yes');


		foreach ($jsonArray['data'] as $index => $json) {
			$file = $json['gallery']['file'];
			$album = $json['gallery']['album'];
			if ($album !="") {
				$album = "/".$album;
			}
			$size = FileSizeConvert("public/gallery$album/$file");
			$jsonArray['data'][$index]['gallery']['file']="<a title='$size' target='_blank' href='".base_url()."public/gallery$album/$file'>$file</a>";

			foreach ($list_visible as $key => $value) {
				if ($json['gallery']['visible']==$value[0]) {
					$jsonArray['data'][$index]['gallery']['visible']=$value[1];
				}				
			}
		}

		$this -> output -> set_header('Pragma: no-cache');
        $this -> output -> set_header('Cache-Control: no-store, no-cache');
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}

	
}




/* End of file Gallery.php */
/* Location: ./application/modules/gallery/controllers/Gallery.php */
/* Please DO NOT modify this information : */
/* Generated by WD Codeigniter CRUD Generator 2016-08-09 05:55:51 */
/* indonesiait.com */