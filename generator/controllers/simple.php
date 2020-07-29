<?php
class Simple extends Core {
    private $moduleDir = "";
	
	function __construct()
	{
		$this->login_check();
	}
	
	public function index() {
		$data = "";
		$this->theme('simple',$data);		
	}

	
	
	function login_check(){
		if(!isset($_SESSION['login_user'])){
			header("Location: ".$this->base_url()); 
			exit();
		}
		
		// 10 mins in seconds
		
		// $inactive = 3;
		$inactive = $this->session_timeout(); 
		$session_life = time() - $_SESSION['timeout'];

		// if($session_life > $inactive)
		// {
		// 	$_SESSION['login_user']= null;
		// 	$_SESSION['timeout'] = null;
		// 	session_destroy();
		// 	header("Location: ".$this->base_url()); 
		// }

		$_SESSION['timeout']=time();	
	}
	
	public function generate() {
		$enctype = "";
		foreach ($_POST['component'] as  $value) {			
			if ($value=="file" || $value=="image") {
				$enctype = 'enctype="multipart/form-data"';
				break;
			}
		}

		foreach ($_POST['row_id'] as $key => $value) {				
			$component_list[$key] = $_POST['select_row_'.$value];
			if ($component_list[$key][0]!="") {
				foreach ($component_list[$key] as $key1 => $isi) {
					$list_value = explode(",", $isi);					
					$component_list[$key][$key1]=$list_value;					
				}
			}
		}
		

		if($_POST['module']=="" || $_POST['primary_table']==""){
			$return = array('type'=>'failure', 'message'=>'Data belum lengkap, silahkan lengkapi field dahulu. Pastikan kolom Module, Primary Table, dan Field Column terisi');
			echo json_encode($return);
			exit();
		}else{
			$field = $_POST['field'];

			if(count($field)<2){
				$return = array('type'=>'failure', 'message'=>'Field Column harus terisi, dan minimal harus ada 2 field column.');
				echo json_encode($return);
				exit();
			}
			
			foreach($field as $row){				
				$check_space = strpos($row, " ");
				if ($check_space) {
					$return = array('type'=>'failure', 'message'=>'nama Field tidak boleh ada spasi');
					echo json_encode($return);
					exit();
				}
				

				if($row==""){
					$return = array('type'=>'failure', 'message'=>'Data belum lengkap, silahkan lengkapi field dahulu. Pastikan kolom Module, Primary Table, dan Field Column terisi.');
					echo json_encode($return);
					exit();
				}
			}
		}
		
		
		$field =  $_POST['field'];
		$module_name =  $_POST['module'];
		$module_name_no_space = preg_replace('/\s+/', '', $module_name);
		$class = ucfirst($module_name_no_space);
		$location = $_POST['location'];
		$module_lower = strtolower($module_name_no_space);
		$this->moduleDir = $location.$module_lower;
		$primary_table =  $_POST['primary_table'];

	


		$model = new Model();
		
		if($_POST['table_exist']=="1"){
			if(!$model->table_check($primary_table)){
				$this->generate_table();
			}else{
				if($field[0]!=$model->primary_field($primary_table)){
					$return = array('type'=>'failure', 'message'=>'Table is exsist but primary field not match, please correct.');
					echo json_encode($return);
					exit();
				}
				
				foreach($field as $field_row){
					$field_row = strtolower($field_row);
					$field_row = preg_replace('/\s+/', '', $field_row);
					$real_column = $model->all_field($primary_table);
					
					$status = false;
					foreach($real_column as $real_column_row){
						if($real_column_row['column_name']==$field_row){
							$status = true;
							break;
						}
					}
					
					if($status==false){
						$return = array('type'=>'failure', 'message'=>"Column \"".$field_row."\" not found on table \"".$primary_table."\", please correct.");
						echo json_encode($return);
						exit();
					}
				}
			}
		}
		
		if($_POST['insert_on_module']=="1"){
			$this->insert_on_module($_POST['module']);
		}
		
		
		
		
		$version = "";
		if (file_exists($this->moduleDir) && $_POST['exists']=="0") {
			$version = 1;
    		while (file_exists($this->moduleDir.'_'.(++$version)));
			$this->moduleDir = $this->moduleDir."_".$version;
		}
		


		$this->create_controller($component_list);
		$this->create_m_index();
		$this->create_m_datatables();
		$this->create_v_add($component_list,$enctype);
		$this->create_v_edit($component_list,$enctype);
		$this->create_v_form_js();
		$this->create_v_index_js();
		$this->create_v_index();
		$this->create_v_show($component_list);

		//CREATE DIRECTORY FILE
		foreach ($_POST['component'] as $key => $value) {			
			if ($value=="file" || $value=="image") {
				$name 	= strtolower($primary_table)."_".strtolower($field[$key]);
				$dir 	= "../public/".$name; 
				$this->createDir($dir);	
				
				if ($value=="image") {
					$this->createDir($dir."/thumb");	
				}			
			}
		}
		
		$return = array('type'=>'success', 'message'=>"Generate CRUD Success, Please Testing your Module before use.");
		echo json_encode($return);
		exit();
	}
	
	
	public function create_controller($component_list){
		include './crud_engine/controller.php';
	}
	
	public function create_m_index(){
		include './crud_engine/m_index.php';
	}
	
	public function create_m_datatables(){
		include './crud_engine/m_datatables.php';
	}
	
	public function create_v_add($component_list,$enctype){
		include './crud_engine/v_add.php';
	}
	
	public function create_v_edit($component_list,$enctype){
		include './crud_engine/v_edit.php';
	}
	
	public function create_v_form_js(){
		include './crud_engine/v_form_js.php';
	}
	
	public function create_v_index_js(){
		include './crud_engine/v_index_js.php';
	}
	
	public function create_v_index(){
		include './crud_engine/v_index.php';
	}
	
	public function create_v_show($component_list){
		include './crud_engine/v_show.php';
	}
	
	public function generate_table(){
		$model = new Model();

		$primary_table = $_POST['primary_table'];
		$primary_table = strtolower($primary_table);
		$field = $_POST['field'];
		$typedata = $_POST['typedata'];
		$component = $_POST['component'];
		$custom = $_POST['custom'];

		// sql to create table
		$sql = "CREATE TABLE ".$primary_table." (";
		$index = 0;
		$record_sum = count($field)-1;
		foreach($field as $key => $field_row){
			$field_row = strtolower($field_row);
			$field_row = preg_replace('/\s+/', '', $field_row);
			if($field_row=="desc"){
				echo "
				<script>alert('Nama field tidak boleh DESC');window.history.back();</script>
				";
				exit();
			}
			
			if($index==0){
				$sql .= $field_row." INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
				$index++;
				continue;
			}	
			
			if ($component[$key]=="datepicker") {
				$typedata[$key]="date";
			}
			if ($typedata[$key]=="custom") {
				$typedata[$key]=$custom[$key];
			}

			$sql .= $field_row." ".$typedata[$index]."";
			
			if($index!=$record_sum){
				$sql .= ",";
			}

			$index++;
		}
		$sql .= ")";

		$model->ddl($sql);
	}
	
	public function insert_on_module($module_name=''){
		if ($this->uri(6)!='') $module_name = $this->uri(6);
		if ($module_name=='') {
			echo json_encode(array('type'=>'failure', 'message'=>"Module Name undefine!"));
			exit;
		}
		
		$module_name_no_space = preg_replace('/\s+/', '', $module_name);
		$module_lower = strtolower($module_name_no_space);
		$icon = (isset($_POST['icon']) && $_POST['icon']!='')?'fa '.$_POST['icon']:'fa fa-circle-o';
		$nama_tabel = (isset($_POST['primary_table']))?strtolower($_POST['primary_table']):null;

		$model = new Model();
		$new_sort_order = $model->get_last_sort_order()+1;
		$module_name_ucfirst = ucfirst($module_name);
		
		$id_modules = $model->modules_check($module_lower);

		$sql = "";
		if(!$id_modules){
			if($nama_tabel){				
				$sql = "INSERT INTO wd_modules (title, icon, url, parent, support, sort_order, table_module)
					VALUES ('".$module_name_ucfirst."','".$icon."','".$module_lower."','0','11111','".$new_sort_order."','".$nama_tabel."'); ";
			}else{
				$sql = "INSERT INTO wd_modules (title, url, parent, support, sort_order)
					VALUES ('".$module_name_ucfirst."','".$module_lower."','0','11111','".$new_sort_order."'); ";
			}
			$model->dml($sql);
			$id_modules = $model->modules_check($module_lower);
		}
		
		$id_group_privileges = $model->group_privileges_check($id_modules);
		if(!$id_group_privileges){
			$sql = "INSERT INTO wd_group_privileges (groups_id, modules_id, privilege)
				VALUES ('1','".$id_modules."','11111'); ";
			$model->dml($sql);
		}
		
	}
	public function delete_on_module($module){
		$model = new Model();
		$id_modules = $model->modules_check($module);
		if($id_modules){
			$sql = "DELETE FROM wd_group_privileges WHERE modules_id = '$id_modules' ";
			$model->dml($sql);

			$sql = "DELETE FROM wd_modules WHERE id = '$id_modules' ";
			$model->dml($sql);
		}

	}
	public function template(){	
		$this->theme('template');
	}
	
	public function register(){
		include './controllers/template.php';
	}

	public function unregister(){
		$model = new Model();
		$module = $_GET['data'];
		$location = "../application/modules/backend/";
		$file_db  = "template/db.sql/";
		if ($this->deleteDir($location.$module)) {
			if (file_exists($file_db.$module."_out.sql")) {
				$query = file_get_contents($file_db.$module."_out.sql");			
				$model->multi($query);				
			}
			$this->delete_on_module($module);
			$this->show_msg("Module has been deleted.","success-msg");
		}else{
			$this->show_msg("Module doesn't exist!","warning-msg");
		}
	}
	
	public function show_msg($msg,$css_class){
		echo "<span class='$css_class'>$msg</span>";
	}

	
}
