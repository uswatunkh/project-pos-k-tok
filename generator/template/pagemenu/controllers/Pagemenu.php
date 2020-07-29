<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagemenu extends MY_backend
{
    function __construct()
    {
    	$this->treeString = "";
    	$this->parent=0;
    	$this->posisi=0;

        parent::__construct();
		$this->load->database();
		$this->load->model('m_index');
		
        //library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Page menu');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Page menu';
		$this->data['sub_primary_title'] = '';
		
		$this->data['sub_title'] = 'Page menu';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_page_menu = 'page_menu';

			
		$this->validation_rule();
    }
	
	
	// {MODEL} //
	public function get_menu_last_position(){
		$strQuery = "select max(position) as jml from page_menu";
		$result = $this->db->query($strQuery) -> result_array();
		return ($result[0]['jml']+1);
	}

	public function get_pagemenu_parent($id)	{	
		$strQuery = "select * from page_menu where parent='$id' order by position";
		$query = $this->db->query($strQuery);
		return $query -> result_array();	
	}

	// {VIEW} //

	function index(){
		
		$this->rule->type('R');

		//Run validate with js
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		if ($this->input->get('id')!="") {
			$id = $this->urlcrypt->decode($this->input->get('id'));
			$this->data['list'] = $this->wd_db->get_data_row($this->table_page_menu,array('id'=>$id));
			$this->data['form'] = getview('edit');
		}else{
			$this->data['list']='';
			$this->data['form'] = getview('add');
		}
		//Nestable
		$this->load_tree();
		$this->data['pagemenu'] = $this->treeString;
		$this->data['css'] = getview('nestable_css');		
		$this->layout->set_include('inline',getview('nestable_js',$this->data));
		$this->layout->set_include_group('form');		
		$this->layout->theme('backend','index', $this->data);	
	}
																																																																																																																																																																																																																																																															

	function load_tree($id=0)	{
		$pagemenu_root = $this->get_pagemenu_parent($id);

		if(count($pagemenu_root)>0){
			$treeOLOpen = '<ol class="dd-list">';
			$this->treeString = $this->treeString.$treeOLOpen;

			foreach ($pagemenu_root as $row_root) {
				$status = ($row_root['status']==0)? ' <i class="badge bg-yellow">Hide</i>' : '';
				$treeStringChild = '
<li class="dd-item dd3-item" data-id="'.$row_root['id'].'">
	<div class="dd-handle dd3-handle"></div>
	<div class="dd3-content">
	'.$row_root['name'].$status.'		

		<div class="pull-right" style="margin-top: -3px" >
			<div class="checkbox no-margin">
				<label>
					<a goto="'.base_url().admin_dir().this_module().'/edit?id='.$this->urlcrypt->encode($row_root['id']).'" class="hidden btn-u btn btn-default btn-xs edit-form">
				  		<i class="glyphicon glyphicon-pencil "></i></a>
				  	<a id="'.$this->urlcrypt->encode($row_root['id']).'" class="hidden btn-d btn btn-default btn-xs btn-delete" data-toggle="modal" data-target="#myModal">	  	
				  		<i class="glyphicon glyphicon-trash "></i></a>
				</label>
			</div>													
		</div>

	</div>
				';

				$this->treeString = $this->treeString.$treeStringChild;
				$this->load_tree($row_root['id']);

				$treeLIClose = '</li>';
				$this->treeString = $this->treeString.$treeLIClose;
			}

			$treeOLClose = '</ol>';
			$this->treeString = $this->treeString.$treeOLClose;
		}
		

	}

	function save_tree($data)
	{
		if(count($data)>0){
			$parent = $this->parent;
			for ($i=0; $i < count($data); $i++) { 
				$data_input = array('parent' => $parent,'position' => $this->posisi);
				$field = array('id' => $data[$i]['id']);
		
				$this->wd_db->edit_dml($this->table_page_menu,$data_input,$field);

				$this->posisi = $this->posisi + 1;

				if(isset($data[$i]['children'])){
					$this->parent = $data[$i]['id'];
					$this->save_tree($data[$i]['children']);
				}
			}
		}
	}

	function save_position()
	{
		$json_string = $this->input->post('menu-position');
		$data_menu = json_decode($json_string,true);		
		$this->save_tree($data_menu);
		redirect(admin_dir().this_module());
	}
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
			array('field'   => 'name','label'   => 'Name','rules'   => 'required'),
		);
		$this->data['rules_message'] = array();
	}
	
	
	function add(){
		$this->rule->type('C');
		echo getview('add');
		echo "<script>
			CKEDITOR.replace('text');

		var l = Ladda.create( document.querySelector( 'button.ladda-button' ) );
	
		$('#dt_form').ajaxForm({
			 beforeSerialize: function(form, options) { 
			  for (instance in CKEDITOR.instances)
					CKEDITOR.instances[instance].updateElement();
			},
			beforeSend: function() {
				l.toggle();
			},
			uploadProgress: function(event, position, total, percentComplete) {
				$('.ladda-label').html(percentComplete+'%');
				l.setProgress(percentComplete/100);
			},
			success: function(xhr) {
			},
			complete: function(xhr) {
				l.setProgress(1);
				var n = xhr.responseText.search('<!DOCTYPE html>');
				var s = xhr.responseText.search('<!doctype html>');

				if (n>=0 || s>=0) {
					$( 'body' ).html(xhr.responseText);
				}else{
					location.href = xhr.responseText;
				}
			}
		}); 
	</script>
	<style>	.callout{ display:none!important} </style>";


	}

	function edit(){
		$this->rule->type('U');
		
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$this->load->library('urlcrypt');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		$this->data['list'] = $this->wd_db->get_data_row($this->table_page_menu,array('id'=>$id));
		echo getview('edit',$this->data);
		
		echo "<script>
			CKEDITOR.replace('text');

		var l = Ladda.create( document.querySelector( 'button.ladda-button' ) );
	
		$('#dt_form').ajaxForm({
			 beforeSerialize: function(form, options) { 
			  for (instance in CKEDITOR.instances)
					CKEDITOR.instances[instance].updateElement();
			},
			beforeSend: function() {
				l.toggle();
			},
			uploadProgress: function(event, position, total, percentComplete) {
				$('.ladda-label').html(percentComplete+'%');
				l.setProgress(percentComplete/100);
			},
			success: function(xhr) {
			},
			complete: function(xhr) {
				l.setProgress(1);
				var n = xhr.responseText.search('<!DOCTYPE html>');
				var s = xhr.responseText.search('<!doctype html>');

				if (n>=0 || s>=0) {
					$( 'body' ).html(xhr.responseText);
				}else{
					location.href = xhr.responseText;
				}
			}
		}); 
	</script>
	<style>	.callout{ display:none!important} </style>";

	}

	// {ACTION} //
	function save_action(){
		$this->rule->type('C');
		
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module());

		$data = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text'),
			'href' => $this->input->post('href'),
			'parent' => 0,
			'position' => $this->get_menu_last_position(),
			'base_url' => $this->input->post('base_url'),
			'status' => $this->input->post('status')
		);
		
		$this->wd_db->add_dml_get_id($this->table_page_menu,$data);
		
		redirect(admin_dir().this_module());
	}
	
	function update_action(){
		$this->rule->type('U');		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/index?id='.$this->input->post('id'));
		
		$old = $this->wd_db->get_data($this->table_page_menu,array('id' => $id)) ;

		$data = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text'),
			'href' => $this->input->post('href'),
			'base_url' => $this->input->post('base_url'),
			'status' => $this->input->post('status')
			
			
		);

		$where = array(
			'id' => $id
		);
		
		$this->wd_db->edit_dml($this->table_page_menu,$data,$where);
			
		redirect(admin_dir().this_module());	
	}
	
	function delete_action(){
		$this->rule->type('D');
		$id[]= $this->input->get('id');		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_page_menu,'id','name','',$id);
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');


		$this->wd_db->del_dml_where_in($this->table_page_menu,'id',$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	
}




/* End of file Pagemenu.php */
/* Location: ./application/modules/pagemenu/controllers/Pagemenu.php */
/* Please DO NOT modify this information : */
/* Generated by WD Codeigniter CRUD Generator 2016-08-11 05:26:38 */
/* indonesiait.com */
