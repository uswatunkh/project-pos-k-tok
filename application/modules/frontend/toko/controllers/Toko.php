<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends MY_frontend{

	public function __construct(){
		parent::__construct();
		$this->load->model('my_m');
	}

	public function index(){
		$data['content'] = 'index';
		$id_pemilik = $this->input->get("id_user");
		$sql = $this->db->query("SELECT * FROM toko WHERE id_pemilik = ".$id_pemilik." ")->result();
		$data['sql_toko'] = $sql;
		$this->view($data,false);
	}

	public function tambah_toko(){
		//fungsi untuk tambah toko
	}

	public function edit_toko(){
		//fungsi untuk edit toko
	}

	public function hapus_toko(){
		//fungsi untuk hapus toko
	}

	
}