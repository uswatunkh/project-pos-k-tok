<?php if (! defined('BASEPATH')) EXIT ('No direct script access allowed');

class M_admin extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function cek_login($email, $password) {		
		$query = $this->db->query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
		return $query->result();
	}	
}
