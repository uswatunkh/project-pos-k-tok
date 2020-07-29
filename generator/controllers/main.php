<?php

class Main extends Core {
   
	function __construct()
	{
		
	}
	
	public function index() {
    	$data['title'] = "title";
		$data['jobs'] = "jobs";
		
		$this->theme('simple',$data);
	}
	
	public function hihi() {
		echo $this->tes();
       	echo "hihi";
    }
	
	public function hoho() {
    
    }
	
}
