<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends MY_frontend{

	public function __construct(){
		parent::__construct();
		$this->load->model('my_m');
	}

	public function index(){
		$data['content'] = 'index';
		$data['id_kasir'] = $this->input->get("id_kasir");
		$this->view($data,false);
	}

	public function tambah_kasir(){
		$data['content'] = 'tambah_kasir';
		$this->view($data,false);
	}

	
}