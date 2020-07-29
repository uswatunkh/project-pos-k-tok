<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->load->model('m_admin');
	}


	function index(){
		if( $this->session->userdata('my_id')) redirect(base_url('dashboard'), 'refresh');
		$data=null;
		$this->load->view('index');
		// echo str_replace("\t", ' ', str_replace("\n", '', $this->load->view('index',$data,TRUE)));
	}

	function login(){
		$user = $this->input->post('user');
		$password = $this->input->post('password');
		if (!$user || !$password) die(json_encode('Lengkapi form'));
		$password = md5(md5($password));
        $e = $this->m_admin->cek_login($user, $password, null);
		if ($e) {
			$this->session->set_userdata('my_id', $e[0]);
			echo json_encode('ok');
		}else{
			echo json_encode('User atau password tidak cocok');
		}
	}

	function logout(){
		$this->session->unset_userdata(array('my_id'));
		redirect(base_url().'auth/', 'refresh');
	}

}
