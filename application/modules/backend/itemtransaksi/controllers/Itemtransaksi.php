<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Itemtransaksi extends MY_backend
{
    function __construct()
    {
        parent::__construct();

		
        //library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Item Transaksi');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Item Transaksi';
		$this->data['sub_primary_title'] = '';
		
		$this->data['sub_title'] = 'Item Transaksi';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_item_transaksi = 'item_transaksi'; 
			
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
		$this->data['tb_transaksi'] = $this->wd_db->select_data('select id,id from transaksi');
		$this->data['tb_item_barang'] = $this->wd_db->select_data('select id,nama from item_barang');

		$this->data['list'] = $this->wd_db->get_data_row($this->table_item_transaksi,array('id'=>$id));
		
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
		$this->data['tb_transaksi'] = $this->wd_db->select_data('select id,id from transaksi');
		$this->data['tb_item_barang'] = $this->wd_db->select_data('select id,nama from item_barang');

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
		$this->data['tb_transaksi'] = $this->wd_db->select_data('select id,id from transaksi');
		$this->data['tb_item_barang'] = $this->wd_db->select_data('select id,nama from item_barang');

		$this->data['list'] = $this->wd_db->get_data_row($this->table_item_transaksi,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('C');
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');

		$data = array(
			'id_transaksi' => $this->input->post('id_transaksi'),
			'id_item_barang' => $this->input->post('id_item_barang'),
			'jml_input' => $this->input->post('jml_input'),
			'harga' => $this->input->post('harga')
		);
		
		$this->wd_db->add_dml_get_id($this->table_item_transaksi,$data);
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		$this->rule->type('U');		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$old = $this->wd_db->get_data($this->table_item_transaksi,array('id' => $id)) ;

		$data = array(
			'id_transaksi' => $this->input->post('id_transaksi'),
			'id_item_barang' => $this->input->post('id_item_barang'),
			'jml_input' => $this->input->post('jml_input'),
			'harga' => $this->input->post('harga')
		);

		
		
		$where = array(
			'id' => $id
		);
		
		$this->wd_db->edit_dml($this->table_item_transaksi,$data,$where);
			
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));	
	}
	
	function delete_action(){
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_item_transaksi,'id','id_transaksi');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		$this->rule->type('D');
		$this->wd_db->del_dml_where_in($this->table_item_transaksi,'id',$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'item_transaksi.id'));
		$jsonArray = $this -> datatable -> datatableJson(array());


		foreach ($jsonArray['data'] as $index => $json) {
		}

		$this -> output -> set_header('Pragma: no-cache');
        $this -> output -> set_header('Cache-Control: no-store, no-cache');
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}




/* End of file Itemtransaksi.php */
/* Location: ./application/modules/itemtransaksi/controllers/Itemtransaksi.php */
/* Please DO NOT modify this information : */
/* Generated by IndonesiaIT Codeigniter CRUD Generator 2020-07-25 02:47:43 */
/* indonesiait.com */