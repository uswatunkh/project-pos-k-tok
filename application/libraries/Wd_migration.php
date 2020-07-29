<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wd_migration{
	var $CI;
	var $temp_date="";
	
	public function __construct($params){
		$CI =& get_instance();
		$this -> CI = $CI;
		$this->CI->load->model('wd_db');
	}
	
	public function run(){
		$database = $this->get_db_file();
		
		if(count($database)==0){
			return;
		}
		
		if(isset($database['all']) && count($database['all'])>0){
			$last_db_file_all = $database['all'][0];
			
			$db_check_on_server = $this->CI->wd_db->select_data("select * from wd_migration where mode='all' order by file desc limit 0,1");
			
			if(count($db_check_on_server)>0){
				
				
				$d1 = new DateTime($last_db_file_all['date']);
				$d2 = new DateTime($db_check_on_server[0]['date']);
				
				if($d1 > $d2){
					$this->backup();
					$this->restore($last_db_file_all['file']);
				}
			}
			else{
				$this->restore($last_db_file_all['file']);
			}
		}
		
		if(isset($database['add']) && count($database['add'])>0){
			for($index=(count($database['add'])-1);$index>=0;$index--){
				
				$last_db_file_add = $database['add'][$index];
				
				$d1 = new DateTime($last_db_file_add['date']);
				$d2 = new DateTime($last_db_file_all['date']);
				
				if($d1 > $d2){
					$this->backup();
					
					$exist = $this->CI->wd_db->get_data_row("wd_migration",array('file'=>$last_db_file_add['file']));
					if($exist==''){
						$this->restore($last_db_file_add['file']);
					}
				}
			}
		}
		
		
	}
	
	public function get_db_file(){
		
		$dir = "./db/";
		
		$data = [];
		$index = 0;
		$index_all = 0;
		$index_add = 0;
		// Open a directory, and read its contents
		if (is_dir($dir)){
			$files = scandir($dir,1);
			
			foreach($files as $file){
				if($file!="." && $file!=".." && strlen($file)==26){
					$data['raw'][$index]['file'] = $file;
					$data['raw'][$index]['date'] = substr($file,0,4)."-".substr($file,4,2)."-".substr($file,6,2)." ".substr($file,9,2).":".substr($file,11,2).":".substr($file,13,2);
					$data['raw'][$index]['mode'] = substr($file,16,3);
					
					$exist = $this->CI->wd_db->get_data_row("wd_migration",array('file'=>$file));
					$data['raw'][$index]['status'] = "";
					if($exist!=''){
						$data['raw'][$index]['status'] = $exist['status'];
					}
					
					if($data['raw'][$index]['mode']=="all"){
						$data['all'][$index_all]['file'] = $data['raw'][$index]['file'] ; 
						$data['all'][$index_all]['date'] = $data['raw'][$index]['date'] ;
						$data['all'][$index_all]['mode'] = $data['raw'][$index]['mode'] ;
						$data['all'][$index_all]['status'] = $data['raw'][$index]['status'] ;
						
						$index_all++;
					}
					
					if($data['raw'][$index]['mode']=="add"){
						$data['add'][$index_add]['file'] = $data['raw'][$index]['file'] ; 
						$data['add'][$index_add]['date'] = $data['raw'][$index]['date'] ;
						$data['add'][$index_add]['mode'] = $data['raw'][$index]['mode'] ;
						$data['add'][$index_add]['status'] = $data['raw'][$index]['status'] ;
						
						$index_add++;
					}
					
					$index++;
				}
			}
		}
		
		return $data;
	}
	
	function check_dir($dir){
		if (!file_exists($dir)) {
			$old = umask(0);
			mkdir($dir, 0775, true);
			umask($old);
		}
	}
	
	public function backup(){
		$path = 'db/backup/';
		$this->CI->load->helper('file');
		$this->CI->load->dbutil();
		
		$name = "db_".date('Ymd_His');
		if($this->temp_date==$name){
			return;
		}
		$this->temp_date = $name;
		
		$this->check_dir($path);

		$prefs = array(
		        // 'tables'     => array('table1', 'table2'),
		        'ignore'     => 'wd_backup_db',
		        'format'     => 'zip',
		        'filename'   => $name.'.sql',
		        'add_drop'   => TRUE, 
		        'add_insert' => TRUE,
		        'newline'    => "\n"
		);
		
		write_file($path.$name.".zip", $this->CI->dbutil->backup($prefs)	);

		$data = array(
			'name'      => $name.".zip",
			'user'      => "1"
		);		
		$this->CI->wd_db->add_dml_get_id('wd_backup_db',$data);
	}
	
	public function restore($file){
		$db_file = "./db/".$file;
		
		$file_date = substr($file,0,4)."-".substr($file,4,2)."-".substr($file,6,2)." ".substr($file,9,2).":".substr($file,11,2).":".substr($file,13,2);
		$file_mode = substr($file,16,3);
		
		$templine = "";
		$lines = file($db_file);
	
		$prcnt = 100/count($lines);
		
		$this->CI->db->query("SET FOREIGN_KEY_CHECKS=0");
		foreach ($lines as $num => $line ){

			if (substr($line, 0, 2) == '--' || $line == '')
				continue;

			$templine .= $line;
			
			if (substr(trim($line), -1, 1) == ';'){
				$this->CI->db->query($templine);
				$templine = '';
			}


		}
		$this->CI->db->query("SET FOREIGN_KEY_CHECKS=1");
		
		$data = array(
			'file' => $file,
			'date' => $file_date,
			'mode' => $file_mode,
			'status' => date('Y-m-d H:i:s')
		);
		
		$this->CI->wd_db->del_dml("wd_migration",'file',$file);
		$this->CI->wd_db->add_dml("wd_migration",$data);
	}
}
