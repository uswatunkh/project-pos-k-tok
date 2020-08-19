<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_m extends CI_Model {	

    function tampil_home(){
	
		   return $this->db->get('user');
	} 

	public function cek_pwd($password) {		
		$query = $this->db->query("SELECT * FROM user WHERE  password = '$password'");
		return $query->result();
	}	
	

   
    function ubah_data ($id){
		
		$data = array(
		'nama'=> $this->input->post('nama'),
		'email'=> $this->input->post('email'),
		
		'alamat'=> $this->input->post('alamat'),
		);
	//	$this->db->where('id', $this->session->userdata('id'));
		//$this->db->set('nama',$nama);
	  // $this->db->where('id',$id);
	  
	  $this->db->where(array('id'=> $id));
	  $this->db->update('user',$data);
	  
		
		


			$this->session->set_flashdata('message', 
		


		'
		</div><!-- /.box-header -->
		<div class="box-body">
		 
		  <div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i>Edit Data Berhasil !</h4>
		
			
		  </div>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
						');
			redirect('../project-pos-k-tok/profile');
	}


	

}
