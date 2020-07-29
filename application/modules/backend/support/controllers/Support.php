<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends MY_backend {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb/untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Support');
		$this->breadcrumb->add_crumb('Warranty');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Support';
		$this->data['sub_primary_title'] = 'Warranty';
		
		$this->data['sub_title'] = 'Warranty';
		$this->layout->set_title($this->data['sub_title']);
			
	}
	
	// {VIEW} //
	function index(){
		$this->data['app_name'] = $this->option('warranty app name');
		$this->data['lisensi']  = $this->option('warranty release');
		$this->data['garansi']  = $this->option('warranty guarantee');
		$this->data['release']  = $this->option('warranty Licence');
		$this->layout->theme('backend','index', $this->data);	
	}
	private function option($name){
		$q = $this->wd_db->get_row('wd_options',array('name'=>$name));
		return $q['value'];
	}
	
	
}