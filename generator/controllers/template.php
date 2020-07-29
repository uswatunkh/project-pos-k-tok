<?php
$model = new Model();
if (isset($_GET['data'])) {
	$module = $_GET['data'];
	$location = "../application/modules/backend/";
	$template = "template/";
	$file_db  = $template."db.sql/";
	$already = "Template register failed, destination folder already exists!!";

	// 	$this->insert_on_module($module);
	// exit;
	if (!file_exists($location.$module)) {
		if(!$model->table_check($module)){					
			if (file_exists($file_db.$module."_in.sql")) {
				$query = file_get_contents($file_db.$module."_in.sql");			
				$model->multi($query);				
			}
		}				
		$this->insert_on_module($module);
		if (file_exists($location.$module)) {
			echo $already;	exit();
		}

		$d = scandir($template.$module);
		foreach ($d as  $mvc) {
			if (!in_array($mvc, array('.','..'))) {
				$this->createDir($location.$module."/$mvc");
				$e = scandir($template.$module."/$mvc");
				foreach ($e as $isi) {
					if (!in_array($isi, array('.','..'))) {
						copy($template.$module."/$mvc/$isi", $location.$module."/$mvc/$isi");
					}
				}
			}
		}
		$this->show_msg("Module installing success.","success-msg");
	}else{
		$this->show_msg("Module already exists!","warning-msg");
	}


	
}
