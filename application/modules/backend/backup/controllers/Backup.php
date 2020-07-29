<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends MY_backend
{
    function __construct()
    {
        parent::__construct();
		
		$this->load->database();
        //library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		$this->load->library('zip');

		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Backup');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Backup';
		$this->data['sub_primary_title'] = '';
		
		$this->data['sub_title'] = 'Backup Database';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_backup_db = 'wd_backup_db'; 
		$this->path = 'db/backup/';
			
		$this->validation_rule();
    }
	
	// {VIEW} //
	function index(){

		$this->rule->type('R');
		
		$this->layout->set_include('css', 'AdminLTE/plugins/iCheck/all.css');
		$this->layout->set_include('js', 'AdminLTE/plugins/iCheck/icheck.min.js');
	
		$this->layout->set_include_group('index');
		$this->layout->set_include('inline',getview('index_js',$this->data));
		$this->layout->theme('backend','index', $this->data);	
	}
	
	
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
		);
		$this->data['rules_message'] = array();
	}
	
	function add(){
		$this->rule->type('C');
		
		//Run validate with js
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		$this->data['tb_wd_users'] = $this->wd_db->select_data('select id,username from wd_users');

		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->theme('backend','add', $this->data);	
	}
	
	

	function get_files_from_folder($directory, $put_into) {

	    if ($handle = opendir($directory)){
	        while (false !== ($file = readdir($handle))) 
	        {
	            if (is_file($directory.$file)) 
	            {
	                $fileContents = file_get_contents($directory.$file);
	                $this->zip->add_data($put_into.$file, $fileContents);

	            } elseif ($file != '.' and $file != '..' and is_dir($directory.$file)) {

	                $this->zip->add_dir($put_into.$file.'/');

	                $this->get_files_from_folder($directory.$file.'/', $put_into.$file.'/');
	            }

	        }//end while

	    }//end if

	    closedir($handle);
	}

	function check_dir($dir){
		if (!file_exists($dir)) {
			$old = umask(0);
			mkdir($dir, 0775, true);
			umask($old);
		}
	}


	// {ACTION} //
	function save_action(){
		$this->rule->type('C');
		$this->load->helper('file');
		$this->load->dbutil();
		
		if($this->input->get('confirm') == null){
			$this->confirm_modal($this->table_backup_db,'id','name',$function='save_action');
			return;
		}

		$name = "db_".date('Ymd_His');		
		$this->check_dir($this->path);

		$prefs = array(
		        // 'tables'     => array('table1', 'table2'),
		        'ignore'     => 'wd_backup_db',
		        'format'     => 'zip',
		        'filename'   => $name.'.sql',
		        'add_drop'   => TRUE, 
		        'add_insert' => TRUE,
		        'newline'    => "\n"
		);

		if ($this->input->get('file')== 1) {
			$this->get_files_from_folder("public/",'');
			$this->zip->archive($this->path.str_replace("db_", "file_", $name).".zip"); 
			$this->zip->clear_data();
		}
		
		write_file($this->path.$name.".zip", $this->dbutil->backup($prefs)	);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');

		$data = array(
			'name'      => $name.".zip",
			'file'      => $this->input->get('file'),
			'user'      => $_SESSION['user_id']
		);		
		$this->wd_db->add_dml_get_id($this->table_backup_db,$data);
		
		redirect(admin_dir().this_module());
	}
	
	
	function delete_action(){
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_backup_db,'id','name');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		foreach ($del_id as $id) {
			$old = $this->wd_db->get_data($this->table_backup_db,array('id' => $id)) ;
			$name = $old[0]['name'];
			$file = str_replace("db_", "file_", $name);
			@unlink($this->path.$name);
			@unlink($this->path.$file);
		}
		$this->wd_db->del_dml_where_in($this->table_backup_db,'id',$del_id);
		redirect(admin_dir().this_module());
	}

	function unzip($zip_file, $path_to_extract=''){
		$this->load->library('unzip');
		if ($path_to_extract=='') {
			$this->unzip->extract($zip_file);
		}else{
			$this->unzip->extract($zip_file, $path_to_extract);
		}
		return true;
	}


	function restore_db(){
		if($this->input->get('confirm') == null){
			$this->confirm_modal($this->table_backup_db,'id','name',$function='restore_exec');
			return;
		}
	}

	function restore_exec(){
		
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		
		$del_id = $this->session->flashdata('del_id');
		foreach ($del_id as $id) {
			$old = $this->wd_db->get_data_row($this->table_backup_db,array('id' => $id)) ;
			$name = $old['name'];
			$extract_to = 'temp/';
			$this->check_dir($extract_to);

			if ($this->unzip($this->path.$name,$extract_to)) {
				$db_file = $extract_to.str_replace(".zip", ".sql", $name);
				$templine = '';
				$lines = file($db_file);				
				$prcnt = 100/count($lines);

				$this->db->query("SET FOREIGN_KEY_CHECKS=0");
				foreach ($lines as $num => $line ){

					$this->msg_json(intval($num*$prcnt)."%",$num*$prcnt);

					if (substr($line, 0, 2) == '--' || $line == '')
						continue;

					$templine .= $line;
					if (substr(trim($line), -1, 1) == ';'){
						$this->db->query($templine);
						$templine = '';
					}
					
										
				}
				$this->db->query("SET FOREIGN_KEY_CHECKS=1");
				@unlink($db_file);
			}

			if ($this->input->get('file') == '1') {
				$this->msg_json('Please wait...',$num*$prcnt);
				sleep(1);
				$file_name = str_replace("db_", "file_", $name);
				$this->unzip($this->path.$file_name,'public/');
			}

			$this->msg_json('DONE','100');

		}
	}

	function msg_json($msg,$progress){
		$d = array('message' => $msg , 'progress' => $progress);
	    echo "data: " . json_encode($d) . PHP_EOL;
	    echo PHP_EOL;				     
	    ob_flush();
	    flush();
	}

	public function confirm_modal($table,	$where,	$field_show, $function,	$id='', $file=''){
		$del_id_encode = ($id=='') ? $this->input->post('checkbox') : $id ; //array()
		if($del_id_encode!=null){
			foreach($del_id_encode as $row){
				$del_id[] = $this->urlcrypt->decode($row);
			}
		}
		else{
			$del_id = null;
		}
		
		$this->data['row'] = $this->wd_db->get_data_delete_confirmation($table,$where,$del_id);
		$this->data['field_show'] = $field_show;
		$this->data['table']      = $table;
		$this->data["function"]   = $function;
		$this->session->set_flashdata('del_id', $del_id);
		$this->load->view('backup/modal', $this->data);
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'wd_backup_db.id'));
		
		$jsonArray = $this -> datatable ->order_by('date', 'desc');
		$jsonArray = $this -> datatable -> datatableJson(array());

		$list_file[0] = array('0','No');
		$list_file[1] = array('1','Yes');


		foreach ($jsonArray['data'] as $index => $json) {
			$data      = $json['wd_backup_db']['name'];
			$data_file = str_replace("db_", "file_", $data);
			$size      = FileSizeConvert($this->path.$data);
			$size_file = FileSizeConvert($this->path.$data_file);

			$jsonArray['data'][$index]['wd_backup_db']['name']="<a title='$size' href='".base_url($this->path.$data)."'>$data</a>";

			if ($json['wd_backup_db']['file']== 1) {
				$jsonArray['data'][$index]['wd_backup_db']['file']="<a title='$size_file' href='".base_url($this->path.$data_file)."'>$data_file</a>";
			}else{
				$jsonArray['data'][$index]['wd_backup_db']['file']="No";
			}
			

			$jsonArray['data'][$index]['wd_backup_db']['date'] = convertDate($jsonArray['data'][$index]['wd_backup_db']['date'],"dmy : hms");
		}

		$this -> output -> set_header('Pragma: no-cache');
        $this -> output -> set_header('Cache-Control: no-store, no-cache');
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}




/* End of file Backup.php */
/* Location: ./application/modules/backup/controllers/Backup.php */
/* Please DO NOT modify this information : */
/* Generated by IndonesiaIT Codeigniter CRUD Generator 2016-11-21 05:52:28 */
/* indonesiait.com */