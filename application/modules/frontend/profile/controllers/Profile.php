<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_frontend{

	public function __construct(){
		parent::__construct();
		$this->load->model('my_m');
	}

	public function index(){
		$data['content'] = 'index';
		$this->view($data,false);
	}

	
}