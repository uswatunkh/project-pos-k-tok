<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Explorer extends MY_backend
{
    function __construct()  {
        parent::__construct();

    }

	function index(){
		$this->file();
		
	}

	function elfinder(){
		echo getview('fmgr');
	}
	function file(){
		
		$this->load->library('breadcrumb');	
		$this->data['primary_title'] = '<i class="fa fa-folder-open-o"></i> Public Explorer';
		$this->data['sub_primary_title'] = "<a target='_blank' href='".backend_url().this_module()."/elfinder'>Using elFinder</a>";
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Explorer');
		$this->data['sub_title'] = 'Explorer';
		$this->layout->set_title($this->data['sub_title']);

		

		
		$segs = $this->uri->segment_array();

		$folder = "";
		if ($this->uri->segment(4)!="") {
			foreach ($segs as $key => $value) {
				if ($key>3) {
					$value = str_replace("%20", " ", $value);
					$folder .= "/$value";

				}
			}

		 } 

		if (file_exists("public$folder")) {
			$this->data['link'] = ($folder!="") ? "./public$folder" : "./public";
		}else{
			$this->data['link']='';
		}

 		$this->data['folderpath']= $folder;
 		
 		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; 		
 		$this->data['backurl'] = str_replace($this->uri->slash_segment(count($segs), 'leading'), "", str_replace(" ", "%20", $actual_link) );

		$this->layout->theme('backend','index', $this->data);	
	}

	function elfinder_init(){
		$this->load->helper('path');
	  	$opts = array(
	    // 'debug' => true, 
	    'roots' => array(
	      array( 
	        'driver' => 'LocalFileSystem', 
	        'path'   => realpath("public")."/", 
	        'URL'    => base_url('public') . '/'
	        // more elFinder options here
	      ) 
	    )
	  );
	  $this->load->library('elfinder_lib', $opts);
	}
	
	
}

