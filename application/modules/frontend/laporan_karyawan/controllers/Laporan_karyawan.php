<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_karyawan extends MY_frontend{

	public function __construct(){
		parent::__construct();
		$this->load->model('my_m');
	}

	public function index(){
		$data['content'] = 'index';
		$data['id_kios'] = $this->input->get("id_toko");
		$this->view($data,false);
	}

	
}