<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_backend
{
    function __construct()
    {
        parent::__construct();

		
        //library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Transaksi');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Transaksi';
		$this->data['sub_primary_title'] = '';
		
		$this->data['sub_title'] = 'Transaksi';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_transaksi = 'transaksi'; 
			
		$this->validation_rule();
    }
	
	// {VIEW} //
	function index(){
		$this->rule->type('R');
	
		$this->layout->set_include_group('index');
		$this->layout->set_include('inline',getview('index_js',$this->data));
		$this->layout->theme('backend','index', $this->data);	
	}
	
	function show(){
		$this->rule->type('R');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->data['tb_toko'] = $this->wd_db->select_data('select id,nama from toko');
		$this->data['tb_karyawan'] = $this->wd_db->select_data('select id,nama from karyawan');

		$this->data['list'] = $this->wd_db->get_data_row($this->table_transaksi,array('id'=>$id));
		
		$this->layout->theme('backend','show', $this->data);
	}
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
		);
		$this->data['rules_message'] = array();
	}
	
	function add(){
		$this->rule->type('C');
		//Run validate with js
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		$this->data['tb_toko'] = $this->wd_db->select_data('select id,nama from toko');
		$this->data['tb_karyawan'] = $this->wd_db->select_data('select id,nama from karyawan');

		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->theme('backend','add', $this->data);	
	}
	
	function edit(){
		$this->rule->type('U');
		
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$this->load->library('urlcrypt');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js')); 
		$this->data['tb_toko'] = $this->wd_db->select_data('select id,nama from toko');
		$this->data['tb_karyawan'] = $this->wd_db->select_data('select id,nama from karyawan');

		$this->data['list'] = $this->wd_db->get_data_row($this->table_transaksi,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('C');
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');

		$data = array(
			'id_toko' => $this->input->post('id_toko'),
			'id_karyawan' => $this->input->post('id_karyawan'),
			'tgl_transaksi' => $this->input->post('tgl_transaksi'),
			'total_harga' => $this->input->post('total_harga'),
			'bayar' => $this->input->post('bayar')
		);
		
		$this->wd_db->add_dml_get_id($this->table_transaksi,$data);
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		$this->rule->type('U');		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$old = $this->wd_db->get_data($this->table_transaksi,array('id' => $id)) ;

		$data = array(
			'id_toko' => $this->input->post('id_toko'),
			'id_karyawan' => $this->input->post('id_karyawan'),
			'tgl_transaksi' => $this->input->post('tgl_transaksi'),
			'total_harga' => $this->input->post('total_harga'),
			'bayar' => $this->input->post('bayar')
		);

		
		
		$where = array(
			'id' => $id
		);
		
		$this->wd_db->edit_dml($this->table_transaksi,$data,$where);
			
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));	
	}
	
	function delete_action(){
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_transaksi,'id','id_toko');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		$this->rule->type('D');
		$this->wd_db->del_dml_where_in($this->table_transaksi,'id',$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'transaksi.id'));
		$jsonArray = $this -> datatable -> datatableJson(array());


		foreach ($jsonArray['data'] as $index => $json) {
			$jsonArray['data'][$index]['transaksi']['tgl_transaksi']=convertDate($jsonArray['data'][$index]['transaksi']['tgl_transaksi'], 'd m y');

		}

		$this -> output -> set_header('Pragma: no-cache');
        $this -> output -> set_header('Cache-Control: no-store, no-cache');
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}




/* End of file Transaksi.php */
/* Location: ./application/modules/transaksi/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by IndonesiaIT Codeigniter CRUD Generator 2020-07-27 10:46:10 */
/* indonesiait.com */