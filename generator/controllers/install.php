<?php
class Install extends Core {
	
	function __construct()
	{
		$this->login_check();
	}
	
	public function index() {
		$data = "";
		$this->check_version();
		$this->theme('fresh',$data);
		
	}
	
	public function fresh() {
		$core = new Core();
		$database = new Database();

		if($core->validate_post($_POST) == true)
		{
			// First create the database, then create tables, then write config file
			if($database->create_database($_POST) == false) {
				$message = $core->show_message('error',"The database could not be created, please verify your settings.");
			} else if ($database->create_tables($_POST) == false) {
				$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
			} else if ($core->write_config($_POST) == false) {
				$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
			} 

			$path = array(
					array(
						'path' => '../application/modules/backend', 
						'delParent' => true,
						'filter'=>array(
							"auth",
							"backup",
							"dashboard",
							"groups",
							"module",
							"profile",
							"migration",
							"relation",
							"users",
							"support",
							"options"
							)
						),
					array(
						'path' => '../public'	, 
						'delParent' => true,
						'filter' => array('index.html')
						)
					
			);
			foreach ($path as $row) {
				$this->rm_modules(	$row['path'],	$row['delParent'],	$row['filter']);
			}

			// If no errors, redirect to registration page
			if(!isset($message)) {
				// header( 'Location: '.$this->core_url());
				header('Content-Type: text/html; charset=utf-8');
				echo '<title>Install</title>
				<div style="margin-top: 10%;text-align: center; background-color: lightblue; margin-left: 20px;margin-right: 20px;padding: 10px;font-weight: bold;border: solid 2px lightseagreen;font-family: Helvetica">
						Processing success,					<a style="font-weight: normal;font-size: 12px;font-style: italic;text-decoration: none" href="'.$this->core_url().'generator/index.php/simple">Back to home
					</div>';
			}else{
				print_r($message);
				
			}

		}
		else {
			$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
		}		
		
	}
	
	function login_check(){
		if(!isset($_SESSION['login_user'])){
			header("Location: ".$this->base_url()); 
			exit();
		}
		
		// 10 mins in seconds
		
		// $inactive = $this->session_timeout(); 
		// $session_life = time() - $_SESSION['timeout'];

		// if($session_life > $inactive)
		// {
		// 	$_SESSION['login_user']= null;
		// 	$_SESSION['timeout'] = null;
		// 	session_destroy();
		// 	header("Location: ".$this->base_url()); 
		// }

		// $_SESSION['timeout']=time();	
	}
	
	function check_version() {
		$local_version = $this->getVersionControl();
		
		exec('git remote show',$git_name);
		
		if(count($git_name)==0)
			return;	
		exec('git describe --always',$version_mini_hash);
		exec('git rev-list HEAD | wc -l',$version_number);
		exec('git log -1',$line);
		exec('git log -1 --format="%ci"',$last_update);
		exec('git log  --pretty=oneline --format="%ci" | tail -n 1',$first_commit);
		
		if($git_name[0]=="IndoIT_Framework_2.0"){
			$v=0;
			$version_increment =0;
			foreach($local_version["framework_version_increment"] as $row){
				$v++;
				$version_increment = $row;
			}
			
			$last_update = substr($last_update[0], 0, -6);
			$last_update=date_create($last_update);
			$sub_version_number = trim($version_number[0]) - $version_increment;
			
			if($local_version["framework_git_version_number"]==trim($version_number[0]))
				return;
			
			$version["framework"] = $local_version["framework"];
			$version["git_version_number"] = "0";
			$version['git_version_short'] = "v.0";
			$version['git_version_full'] = "v.0";
			$version['display_version'] = "v.0";
			$version['last_update'] = "-"; 
			$version['copyright'] = date('Y');
			$version['version_increment'] = [0];
			$version['framework_git_version_number'] = trim($version_number[0]);
			$version['framework_git_version_short'] = "v.".$v.".".trim($sub_version_number).".".$version_mini_hash[0];
			$version['framework_git_version_full'] = "v.".$v.".".trim($sub_version_number).".$version_mini_hash[0] (".str_replace('commit ','',$line[0]).")";
			$version['framework_display_version'] = "v.".$v.".".trim($sub_version_number);
			$version['framework_last_update'] = date_format($last_update,"d M Y H:i:s"); 
			$version['framework_copyright'] = substr($first_commit[0], 0, 4);
			$version['framework_version_increment'] = $local_version["framework_version_increment"];
		}else{
			$v=0;
			$version_increment =0;
			foreach($local_version["version_increment"] as $row){
				$v++;
				$version_increment = $row;
			}
			
			$last_update = substr($last_update[0], 0, -6);
			$last_update=date_create($last_update);
			$sub_version_number = trim($version_number[0]) - $version_increment;
			
			if($local_version["git_version_number"]==trim($version_number[0]))
				return;
			
			$version["framework"] = $local_version["framework"];
			$version["git_version_number"] = trim($version_number[0]);
			$version['git_version_short'] = "v.".$v.".".trim($sub_version_number).".".$version_mini_hash[0];
			$version['git_version_full'] = "v.".$v.".".trim($sub_version_number).".$version_mini_hash[0] (".str_replace('commit ','',$line[0]).")";
			$version['display_version'] = "v.".$v.".".trim($sub_version_number);
			$version['last_update'] = date_format($last_update,"d M Y H:i:s"); 
			$version['copyright'] = substr($first_commit[0], 0, 4);
			$version['version_increment'] = $local_version["version_increment"];
			$version['framework_git_version_number'] = $local_version["framework_git_version_number"];
			$version['framework_git_version_short'] = $local_version["framework_git_version_short"];
			$version['framework_git_version_full'] = $local_version["framework_git_version_full"];
			$version['framework_display_version'] = $local_version["framework_display_version"];
			$version['framework_last_update'] = $local_version["framework_last_update"];
			$version['framework_copyright'] = $local_version["framework_copyright"];
			$version['framework_version_increment'] = $local_version["framework_version_increment"];
			
		}
		
		$fp = fopen(realpath("../")."/version.json", 'w');
		fwrite($fp, json_encode($version));
		fclose($fp);

		return $version;
	}

	/**
	 * [rm_modules removing junk folders and files on backend/modules]
	 * @return [type] [description]
	 */
	public function rm_modules($path,$deleteParent=true,$filter=array()){
		$core = new Core();
		// $dirPath = realpath($path);		
		$module_name = array();
		if (file_exists($path)) {
			$folder = new DirectoryIterator($path);

			if (count($filter)>0) {									
		  		foreach ($folder as $file) {
				    $filen = $file->getFilename(); 
				    $dot = substr($filen, 0,1); 
			      	if (!$file->isDot() and $dot!="." ){
				        $module_name[] = "$path/$filen";

			      		
				    }
				}


				foreach ($filter as $rowFilter) {
	      			
	      			 if(($key = array_search("$path/$rowFilter", $module_name)) !== false) {
					        unset($module_name[$key]);
					 }
					 
				}
			}else{
				$module_name[] = $path;
			}

			foreach ($module_name as $row_module) {
				$core->deleteDir($row_module,$deleteParent);
			}
			return true;
		}else{
			return false;
		}
	}

}
