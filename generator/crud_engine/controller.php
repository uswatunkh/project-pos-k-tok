<?php

$module_name =  $_POST['module'];
$module_name_no_space = preg_replace('/\s+/', '', $module_name);
$module_name_no_space = strtolower($module_name_no_space);
$class = ucfirst($module_name_no_space);
$title = ucfirst($module_name);
$file_name = ucfirst($class).'.php';
$module_lower = strtolower($module_name_no_space);

$location = $_POST['location'];
$moduleDir = $this->moduleDir;


$primary_table = strtolower($_POST['primary_table']);
$primary_table = preg_replace('/\s+/', '', $primary_table);

$field = $_POST['field'];

$icon = '"fa fa fa-gear"';

$thumb  = $_POST['file_thumb'];
$fileType  = $_POST['file_type'];
$fileSizes = $_POST['file_size'];
$component = $_POST['component'];
$join_table = $_POST['join_table'];
$join_id = $_POST['join_id'];
$join_select = $_POST['join_select'];
$join_data = "";
$global = "";
$thumb_name = "";
$i = 0;

$index = 0;
foreach($component as $key => $component_row){


	if($component_row=="selectjoin"){
		$join_data .= "\t\t\$this->data['tb_".$join_table[$index]."'] = \$this->wd_db->select_data('select ".$join_id[$index].",".$join_select[$index]." from ".$join_table[$index]."');\n";
	}elseif ($component_row=="image" || $component_row=="file") {
		
		$file_allowed = '';
		$split 		= "";
		$file_type  = explode(",", $fileType[$key]);
		foreach ($file_type as $type) {
			if ($i>0) { $split =","; }
			$i++;
			$type = strtolower($type);
			$type = str_replace(" ", "", $type);
			if ($type=="jpg" || $type=="jpeg") {
				$type ="jpg','jpeg";
			}
			$file_allowed .= $split."'".$type."'";	
		}

		$global .="
		\$GLOBALS['folder_".$field[$index]."'] = 'public/".$primary_table."_".strtolower($field[$index])."/';
		\$this->allowed_types = array(".$file_allowed.");
		\$this->file_size = array(".$fileSizes[$index].");";

		if ($component_row=="image"){
			$global .= "		
		\$GLOBALS['thumb_".$field[$index]."'] = '".$thumb[$index]."';			";

		}		
		
	}

	$index++;
}


$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed');

class " . $class . " extends MY_backend
{
    function __construct()
    {
        parent::__construct();

		".$global."
        //library breadcrum/untuk navigasi
		\$this->load->library('breadcrumb');
		\$this->load->library('urlcrypt');
		
		//breadcrumb untuk navigasi
		\$this->breadcrumb->add_crumb('Home');
		\$this->breadcrumb->add_crumb('".$title."');
		
		\$this->data['primary_title'] = '<i class=".$icon."></i> ".$title."';
		\$this->data['sub_primary_title'] = '';
		
		\$this->data['sub_title'] = '".$title."';
		\$this->layout->set_title(\$this->data['sub_title']);
		
		\$this->table_".$primary_table." = '".$primary_table."'; 
			
		\$this->validation_rule();
    }
	
	// {VIEW} //
	function index(){
		\$this->rule->type('R');
	
		\$this->layout->set_include_group('index');
		\$this->layout->set_include('inline',getview('index_js',\$this->data));
		\$this->layout->theme('backend','index', \$this->data);	
	}
	
	function show(){
		\$this->rule->type('R');
		\$id = \$this->urlcrypt->decode(\$this->input->get('id'));
		
		\$this->layout->set_include_group('form');
		\$this->layout->set_include('inline',getview('form_js'));";

$string .= "\n".$join_data."\n";

$string .="		\$this->data['list'] = \$this->wd_db->get_data_row(\$this->table_".$primary_table.",array('".$field[0]."'=>\$id));
		
		\$this->layout->theme('backend','show', \$this->data);
	}
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		\$this->data['rules'] = array(";
		$n = 0;
		$lenght = count($field)-1;
		foreach($field as $rows){
			$label = ucfirst($rows);
			$rule = $_POST['validation'];
			if($rule[$n]!=""){
				if($n>0){
					if ( $component[$n]=='file') {}
					if ( $component[$n]=='image'){} 
					else{
					$string .= "\n\t\t\tarray('field'   => '".$rows."', 'label' => '".$label."','rules'   => '".$rule[$n]."')";
					if($n!=$lenght){
						$string .= ",";
						
					}
					}
				}
				
			}
			$n++;
		}
$string .="\n\t\t);
		\$this->data['rules_message'] = array();
	}
	
	function add(){
		\$this->rule->type('C');";

		$n = 0;
		foreach($field as $rows){
			$label = ucfirst($rows);
			$rule = $_POST['validation'];
			if($rule[$n]!=""){
				if($n>0){
					if ( $component[$n]=='file' || $component[$n]=='image') {
						$string .= "\n\t	array_push( \$this->data['rules'],array('field'   => '".$rows."', 'label' => '".$label."','rules'   => '".$rule[$n]."'));";
					}
				}
				
			}
			$n++;
		}
$string .= "
		//Run validate with js
		\$this->wd_validation->run_validate_js(\$this->data['rules'],\$this->data['rules_message'],'#dt_form','.validate-js-message');";

$string .= "\n".$join_data."\n";

		
$string .="		\$this->layout->set_include_group('form');
		\$this->layout->set_include('inline',getview('form_js'));
		\$this->layout->theme('backend','add', \$this->data);	
	}
	
	function edit(){
		\$this->rule->type('U');
		
		\$this->wd_validation->run_validate_js(\$this->data['rules'],\$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		\$this->load->library('urlcrypt');
		\$id = \$this->urlcrypt->decode(\$this->input->get('id'));
		
		\$this->layout->set_include_group('form');
		\$this->layout->set_include('inline',getview('form_js')); ";

$string .= "\n".$join_data."\n";

$string .="		\$this->data['list'] = \$this->wd_db->get_data_row(\$this->table_".$primary_table.",array('".$field[0]."'=>\$id));
		
		\$this->layout->theme('backend','edit', \$this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		\$this->rule->type('C');
";
		
		foreach ($component as $key => $value) {

			if ($value =="image") {
				
				$string .= "
		if (isset(\$_FILES['".$field[$key]."']['name']) && \$_FILES['".$field[$key]."']['name']!= '') {
			check_files('".$field[$key]."','/add',\$this->file_size,\$this->allowed_types);
			\$updata = file_upload(\$GLOBALS['folder_".$field[$key]."'],'".$field[$key]."',\$GLOBALS['thumb_".$field[$key]."'],'crop');
			if (\$updata['error']==1) {
				\$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/add');
				exit();
			}
			\$".$field[$key]." = \$updata['name'];
		}else{
			\$".$field[$key]." = '';
		}
			";
			}elseif ($value =="file") {
				
			
				$string .= "
		if (isset(\$_FILES['".$field[$key]."']['name']) && \$_FILES['".$field[$key]."']['name']!= '') {
			check_files('".$field[$key]."','/add',\$this->file_size,\$this->allowed_types);
			\$updata = file_upload(\$GLOBALS['folder_".$field[$key]."'],'".$field[$key]."');
			if (\$updata['error']!='') {
				\$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/add');
				exit();
			}
			\$".$field[$key]." = \$updata['name'];
		}else{
			\$".$field[$key]." = '';
		}
			";

			}elseif ($value =="password") {
				$string .= "
		\$".$field[$key]." = \$this->input->post('".$field[$key]."');
		\$re_".$field[$key]." = \$this->input->post('re_".$field[$key]."');
		if (\$".$field[$key]."!='') {
			if (\$".$field[$key]."!=\$re_".$field[$key].") {
				\$this->session->set_flashdata('danger_message', '".$field[$key]." tidak sama !!');
				redirect(admin_dir().this_module().'/add');
				exit();
			}
		}";
			}elseif ($value=="checkbox") {
				$string .= "
		\$".$field[$key]." ='';
		\$sparate ='';	
		if (isset(\$_POST['".$field[$key]."'])) {	
			
			foreach (\$_POST['".$field[$key]."'] as \$key => \$value) {
				if (\$key>0) {	\$sparate =',';		}
				\$".$field[$key]." .= \$sparate.\$value;
			}
			
		}	
		";	
			}elseif ($value=="tag") {
				$string .= "
		\$".$field[$key]." ='';
		\$sparate ='';	
		if (isset(\$_POST['".$field[$key]."'])) {	
			
			foreach (\$_POST['".$field[$key]."'] as \$key => \$value) {
				if (\$key>0) {	\$sparate =',';		}
				\$".$field[$key]." .= \$sparate.\$value;
			}
			
		}	
		";	
		}




		}

		$string .="		
		if(\$this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');

		\$data = array(";
		$n = 0;
		$lenght = count($field)-1;
		foreach($field as $key => $rows){
			if($n>0){
				if ($component[$n] =="file" || $component[$n] =="image" || $component[$n] =="checkbox" || $component[$n] =="tag") {
					$string .= "\n\t\t\t'".$rows."' => \$".$rows;	
				}elseif ($component[$n] =="password") {
					$string .= "\n\t\t\t'".$rows."' => md5(\$".$field[$key].")";				
				}else{					
					$string .= "\n\t\t\t'".$rows."' => \$this->input->post('".$rows."')";
				}

				if($n!=$lenght){
					$string .= ",";
				}
			}
			
			$n++;
		}
$string .="\n\t\t);
		
		\$this->wd_db->add_dml_get_id(\$this->table_".$primary_table.",\$data);
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		\$this->rule->type('U');		
		\$id = \$this->input->post('".$field[0]."');
		\$id = \$this->urlcrypt->decode(\$id);

		if(\$this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.\$this->input->post('id'));
		
		\$old = \$this->wd_db->get_data(\$this->table_".$primary_table.",array('id' => \$id)) ;
";
		foreach ($component as $key => $value) {

			if ($value =="image") {
				
				$string .= "
		if (isset(\$_FILES['".$field[$key]."']['name']) && \$_FILES['".$field[$key]."']['name']!= '') {
			check_files('".$field[$key]."','/edit?id='.\$this->input->post('id'),\$this->file_size,\$this->allowed_types);
			\$updata = file_upload(\$GLOBALS['folder_".$field[$key]."'],'".$field[$key]."',\$GLOBALS['thumb_".$field[$key]."'],'crop');
			if (\$updata['error']==1) {
				\$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/edit?id='.\$this->input->post('id'));
				exit();
			}
			\$".$field[$key]." = \$updata['name'];
			@unlink(\$GLOBALS['folder_".$field[$key]."'].\$old[0]['".$field[$key]."']);
			@unlink(\$GLOBALS['folder_".$field[$key]."'].'thumb/thumb_'.\$old[0]['".$field[$key]."']);	
		}else{
			\$".$field[$key]." = \$old[0]['".$field[$key]."'];
		}
			";
			}elseif ($value =="file") {
				
			
				$string .= "
		if (isset(\$_FILES['".$field[$key]."']['name']) && \$_FILES['".$field[$key]."']['name']!= '') {
			check_files('".$field[$key]."','/add',\$this->file_size,\$this->allowed_types);
			\$updata = file_upload(\$GLOBALS['folder_".$field[$key]."'],'".$field[$key]."');
			if (\$updata['error']!='') {
				\$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/edit?id='.\$this->input->post('id'));
				exit();
			}
			\$".$field[$key]." = \$updata['name'];
			@unlink(\$GLOBALS['folder_".$field[$key]."'].\$old[0]['".$field[$key]."']);						
		}else{
			\$".$field[$key]." = \$old[0]['".$field[$key]."'];
		}
			";

			}elseif ($value =="password") {
				$string .= "
		\$".$field[$key]." = \$this->input->post('".$field[$key]."');
		\$re_".$field[$key]." = \$this->input->post('re_".$field[$key]."');
		if (\$".$field[$key]."!='') {
			if (\$".$field[$key]."!=\$re_".$field[$key].") {
				\$this->session->set_flashdata('danger_message', '".$field[$key]." tidak sama !!');
				redirect(admin_dir().this_module().'/add');
				exit();			
			}
			\$".$field[$key]." = md5(\$".$field[$key].");
		}else{
			\$".$field[$key]." = \$old[0]['".$field[$key]."'];
		}";
			}elseif ($value=="checkbox") {
				$string .= "
		\$".$field[$key]." ='';
		\$sparate ='';	
		if (isset(\$_POST['".$field[$key]."'])) {			
			foreach (\$_POST['".$field[$key]."'] as \$key => \$value) {
				if (\$key>0) {	\$sparate =',';		}
				\$".$field[$key]." .= \$sparate.\$value;
			}
			
		}
		";	
			}elseif ($value=="tag") {
				$string .= "
		\$".$field[$key]." ='';
		\$sparate ='';	
		if (isset(\$_POST['".$field[$key]."'])) {			
			foreach (\$_POST['".$field[$key]."'] as \$key => \$value) {
				if (\$key>0) {	\$sparate =',';		}
				\$".$field[$key]." .= \$sparate.\$value;
			}
			
		}
		";
			}




		}
	$string .="
		\$data = array(";
		$n = 0;
		$lenght = count($field)-1;
		foreach($field as $rows){
			if($n>0){
				if ($component[$n] =="file" || $component[$n] =="image" || $component[$n] =="password" || $component[$n] =="checkbox" || $component[$n] =="tag") {
					$string .= "\n\t\t\t'".$rows."' => \$".$rows;								
				}else{					
					$string .= "\n\t\t\t'".$rows."' => \$this->input->post('".$rows."')";
				}

				if($n!=$lenght){
					$string .= ",";
				}
			}
			
			$n++;
		}
$string .="\n\t\t);

		
		
		\$where = array(
			'".$field[0]."' => \$id
		);
		
		\$this->wd_db->edit_dml(\$this->table_".$primary_table.",\$data,\$where);
			
		redirect(admin_dir().this_module().'/edit?id='.\$this->input->post('".$field[0]."'));	
	}
	
	function delete_action(){
		
		if(\$this->input->get('confirm') == null){
			\$this->confirm_delete(\$this->table_".$primary_table.",'".$field[0]."','".$field[1]."');
			return;
		}
			
		\$del_id = \$this->session->flashdata('del_id');
		\$this->rule->type('D');";
		
	foreach ($component as $key => $value) {
		if ($value=="file" || $value=="image") {
			$string .= "
		foreach (\$del_id as \$id) {
			\$old = \$this->wd_db->get_data(\$this->table_".$primary_table.",array('id' => \$id)) ;
			@unlink(\$GLOBALS['folder_".$field[$key]."'].\$old[0]['".$field[$key]."']);";
			if ($value=="image") {
				$string .="
			@unlink(\$GLOBALS['folder_".$field[$key]."'].'thumb/thumb_'.\$old[0]['".$field[$key]."']);";				
			}
			$string .="
		}";

			
		}
	}
		

		
		$string .= "
		\$this->wd_db->del_dml_where_in(\$this->table_".$primary_table.",'".$field[0]."',\$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		\$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => '".$primary_table.".".$field[0]."'));
		\$jsonArray = \$this -> datatable -> datatableJson(array());\n";

	$to_loop = 0;	
	foreach ($component as $index => $value) {
		if ($value=='select' || $value=="radio" || $value=="checkbox") {
			$to_loop++;	
			$string .="
		\$list_".$field[$index]."= array(";
			foreach ($component_list[$index] as $key => $row) {
				$string .="
			array('".$component_list[$index][$key][0]."','".$component_list[$index][$key][1]."'),";
			}
			$string .="
		);";

		}
	}

	$string .= "\n
		foreach (\$jsonArray['data'] as \$index => \$json) {";

	foreach ($component as $index => $value) {
		if ($value=='file' || $value=='image') {
			$string .="
			\$data = \$json['".$primary_table."']['".$field[$index]."'];
			\$size = FileSizeConvert(\"public/".$primary_table."_".$field[$index]."/\$data\");
			\$jsonArray['data'][\$index]['".$primary_table."']['".$field[$index]."']=\"<a title='\$size' target='_blank' href='\".base_url().\"public/".$primary_table."_".$field[$index]."/\$data'>\$data</a>\";\n";

		}elseif ($value=='ckeditor' || $value=='textarea' || $value=='tag') {
			$string .="
			\$jsonArray['data'][\$index]['".$primary_table."']['".$field[$index]."']=get_substr(\$jsonArray['data'][\$index]['".$primary_table."']['".$field[$index]."'],40);\n";
		}elseif ($value=='datepicker') {
			$string .="
			\$jsonArray['data'][\$index]['".$primary_table."']['".$field[$index]."']=convertDate(\$jsonArray['data'][\$index]['".$primary_table."']['".$field[$index]."'], 'd m y');\n";
		}
	}
	if ($to_loop>0) {	
		$onlist = $_POST['onlist'];
		foreach ($component as $index => $value) {
			if($onlist[$index]=="0"){
				$index++;
				continue;
			}
			
			
			if ($value=='select' || $value=="radio") {
				$string .="
			foreach (\$list_".$field[$index]." as \$key => \$value) {
				if (\$json['".$primary_table."']['".$field[$index]."']==\$value[0]) {
					\$jsonArray['data'][\$index]['".$primary_table."']['".$field[$index]."']=\$value[1];
				}				
			}";
			}elseif ($value=="checkbox") {
				$string .="
			\$isi = explode(',', \$json['".$primary_table."']['".$field[$index]."']);
			foreach (\$isi as \$key => \$value) {
				foreach (\$list_".$field[$index]." as \$l_list) {
					if (\$value==\$l_list[0]) {
						\$isi[\$key]=\$l_list[1];
					}
				}
			}
			\$jsonArray['data'][\$index]['".$primary_table."']['".$field[$index]."'] = implode(',', \$isi);";
			
			}
		}		
	}	

$string .= "
		}\n
		\$this -> output -> set_header('Pragma: no-cache');
        \$this -> output -> set_header('Cache-Control: no-store, no-cache');
        \$this -> output -> set_content_type('application/json') -> set_output(json_encode(\$jsonArray));
	}
}
";

$string .= "\n\n\n\n/* End of file $file_name */
/* Location: ./application/modules/$module_name_no_space/controllers/$file_name */
/* Please DO NOT modify this information : */
/* Generated by IndonesiaIT Codeigniter CRUD Generator ".date('Y-m-d H:i:s')." */
/* indonesiait.com */";


$this->createDir($moduleDir."/controllers/");
$result = $this->createFile($string, $moduleDir."/controllers/" . $file_name);

?>