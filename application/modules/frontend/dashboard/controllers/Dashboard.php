<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_frontend{

	public function __construct(){
		parent::__construct();
	}

        public function index(){		
		$data['content'] = 'index';
		$this->view($data,false);
	}

	


}
