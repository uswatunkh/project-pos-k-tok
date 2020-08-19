<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_frontend{

	public function __construct(){
		parent::__construct();
		$this->load->model('My_m');
		$this->load->helper('url');
		//is_logged_in();
	}

	public function index(){
		
	$data['title']= 'user';
	$data['content'] = 'index';
	$data['user']= $this->My_m->tampil_home('user', ['email' => 
	$this->session->userdata('email')])->row_array();
	

	$this->view($data,false);
		
	}

	public function edit(){
	
		$data['title']= 'user';
		$data['content'] = 'index';
		
		$data['user']=$this->My_m->tampil_home('user', ['id' => 
		$this->session->userdata('id')])->row_array();
		
			//$this->view($data,false);
		//	$id = $this->input->post('id');
		//	$this->My_m->ubah_data($id);



		if ($this->input->post('password')){
			
			$data['password'] = $this->input->post('password');
		} else{
		$this->session->set_flashdata('alertDua', 
		'(*Silahkan Masukkan Password Terdahulu*)');
		redirect('../project-pos-k-tok/profile');} 

		//$this->form_validation->set_rules('nama', 'nama pemilik','required|trim');
		
		
		

		/*script untuk masukkan password sebelum edit profil*/ 

		$password = $this->input->post('password');
		$password = md5(md5($password));
		$e = $this->My_m->cek_pwd($password, null);
		
		if($e) {
			//$this->session->set_userdata('my_id', $e[0]);
			$this->view($data,false);
			$id = $this->input->post('id');
			$this->My_m->ubah_data();
		}else {
			
			$this->session->set_flashdata('alert', '
			(*Password Salah*)');            
			redirect('../project-pos-k-tok/profile');
		}

		
	
		
			
		}

	

	

}