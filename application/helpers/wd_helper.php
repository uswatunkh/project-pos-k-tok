<?php
if ( ! function_exists('element')) {

	function array2csv($array=array(),$name='admin.csv'){
	   if (count($array) == 0) {
	     return null;
	   }
	   ob_start();
	   $df = fopen("public/".$name, 'w');
	   fputcsv($df, array_keys(reset($array)));
	   foreach ($array as $row) {
	      fputcsv($df, $row);
	   }
	   fclose($df);
	   ob_get_clean();
	   return "public/".$name;
	}

	function owner_telegram($msg,$html=false,$chatID='-1001217341669') {
		$html = $html ? "&parse_mode=HTML" : '';
		$token = 'bot982841717:AAGXGlExirdHQWWoU9y_Gj3auQVhzUi28FI';
	    $url = "https://api.telegram.org/" . $token . "/sendMessage?chat_id=" . $chatID.$html;
	    //........
	    $url = $url . "&text=" . urlencode($msg);
	    $ch = curl_init();
	    $optArray = array(
	            CURLOPT_URL => $url,
	            CURLOPT_RETURNTRANSFER => true
	    );
	    curl_setopt_array($ch, $optArray);
	    $result = curl_exec($ch);
	    curl_close($ch);
	}

	function telegram($msg,$html=false,$chatID='-223854054') {
		$html = $html ? "&parse_mode=HTML" : '';
		$token = 'bot666941232:AAEqSFlgc3HPAg5rWATcawNVq4ost6rN4IA';
	    $url = "https://api.telegram.org/" . $token . "/sendMessage?chat_id=" . $chatID.$html;
	    //........
	    $url = $url . "&text=" . urlencode($msg);
	    $ch = curl_init();
	    $optArray = array(
	            CURLOPT_URL => $url,
	            CURLOPT_RETURNTRANSFER => true
	    );
	    curl_setopt_array($ch, $optArray);
	    $result = curl_exec($ch);
	    curl_close($ch);
	}

	function img_src($src,$path,$replace=""){
		$ci = &get_instance();

		$replace = ($replace) ? base_url().$replace : $ci->config->item('assets')."General/not-found.png";
		if(substr($path, -1)!='/') $path.='/';

		if ($src=='') {
			$img=$replace;	
		}else{
			if (file_exists($path.$src)) {
				$img=base_url().$path.$src;
			}else{
				$img=$replace;
			}
		}
		return $img;	
	}
	
	function rupiah($jumlah,$book=null) {
		// return $jumlah ? "Rp. ".number_format($jumlah, 2, ",", ".") :  "";

		if ($jumlah <> 0 or !empty($jumlah)) {
			if ($jumlah < 0) {
				$jumlah = substr($jumlah,1);
				if (isset($book) and $book == 1) $return = "<span class='pull-left'>Rp &nbsp;</span> <span class='pull-right'> -".number_format($jumlah, 2, ",", ".").'</span>';
				else if (isset($book) and $book == 2) $return = "<span class='pull-left'>Rp &nbsp;</span> <span class='pull-right'>(-".number_format($jumlah, 2, ",", ".").')</span>';
				else $return = "Rp -".number_format($jumlah, 2, ",", ".");
			} else {
				if (isset($book) and $book == 1) $return = "<span class='pull-left'>Rp &nbsp;</span> <span class='pull-right'> ".number_format($jumlah, 2, ",", ".").'</span>';
				else if (isset($book) and $book == 2) $return = "<span class='pull-left'>Rp &nbsp;</span> <span class='pull-right'>(".number_format($jumlah, 2, ",", ".").')</span>';
				else $return = "Rp ".number_format($jumlah, 2, ",", ".");   
			}
		} else {
			if (isset($book)) $return = "<span class='pull-left'>Rp &nbsp;</span><span class='pull-right'>0,00</span>";
			else $return = "Rp 0,00";
		}
		return $return;
	}

	function active_menu($name,$uri=1){
		$ci = &get_instance();
		$mdl =$ci->uri->segment($uri);
		if(is_array($name)) return (in_array($mdl, $name)) ? 'active' : '' ;
		else return ($name==$mdl) ? 'active' : '';
	}
	

	function backend_url($param='') {
		$ci = &get_instance();
		if($param!=''){
			return $ci->config->item('backend_url').$param;
		}
		return $ci->config->item('backend_url');
	}

	function admin_dir() {
		$ci = &get_instance();
		return $ci->config->item('admin_dir').'/';
	}
	
	function this_module() {
		$ci = &get_instance();
		$this_module = $ci->uri->segment('2');
		return $this_module;
	}
	
	function debug($data='Debug mode!'){
		echo "<!DOCTYPE html><pre>";
		print_r ($data);
		echo "</pre>";
		exit();
	}
	
	function show_alert($type,$message) {
		if(ISSET($message)){
			switch ($type){
				case "success":
				echo '
				<div class="callout callout-success success_message">
					<p><i class="icon fa fa-check"></i> 
						'.$message.' 
					</p>
				</div>
				';
				break;
				case "danger":
				echo '
				<div class="callout callout-danger danger_message">
					<h4>
						'.$message.' 
					</h4>
				</div>
				';
				break;
				default:
				break;
			}
		}       
	}
	
	function bool_checkbox($value){
		if($value!=null)
			$result = $value;
		else 
			$result = '0';
		
		return $result;
	}
	
	function set_value_edit_text($session_value,$list_value){
		if($session_value!='')
		{
			echo $session_value;
		}else{
			echo $list_value;
		}
	}
	
	function set_value_edit_check($session_value,$data_value,$list_value){
		$result = '';
		if($session_value!='')
		{
			if($session_value==$data_value)
			{
				$result = "checked";
			}
		}else{
			if($data_value==$list_value)
			{
				$result = "checked";
			}
		}
		return $result;
	}	

	
	function set_value_edit_select($session_value,$data_value,$list_value){
		$result = '';		
		if($session_value!='')
		{
			if($session_value==$data_value)
			{
				$result = "selected='selected' ";
			}
		}else{
			if($data_value==$list_value)
			{
				$result = "selected='selected' ";
			}
		}
		
		return $result;
	}
	
	function set_value_edit_select_sort($session_value,$data_value,$list_value){
		$result = '';
		
		if($session_value!='')
		{
			if($session_value==$data_value)
			{
				$result = "selected='selected' ";
			}
		}else{
			if($data_value<$list_value)
			{
				$result = "selected='selected' ";
			}
		}
		
		return $result;
	}
	
	function set_value_select($session_value,$data_value){
		$result = '';
		if($session_value==$data_value)
		{
			$result = "selected='selected' ";
		}
		return $result;
	}
	
	function set_value_check($session_value,$data_value){
		$result = '';
		if($session_value==$data_value)
		{
			$result = "checked";
		}
		return $result;
	}
	
	function wd_set_value($value){
		$ci = &get_instance();
		$data = $ci->session->flashdata('input_post');
		$result = '';
		if(isset($data[$value]))
			$result = $data[$value];
		return $result;
	}
	
	function wd_validation_errors(){
		$ci = &get_instance();
		$result = $ci->session->flashdata('validation_errors');
		if(isset($result))
			$ci->layout->set_include('css', 'AdminLTE/wd_custom/validate.css');
		return $result;
	}
	

	function redirect_ajax($url,$admin_url='') {
		$ci = &get_instance();
		if($admin_url=='') $admin_url = $ci->config->item('backend_url');
		echo "<script> window.location.href = '".$admin_url.$url."'; </script>";
	}

	function menu_active($uri,$menu) {
		$ci = &get_instance();
		if($ci->uri->segment($uri)==$menu){
			echo 'class="active"'; 
		}
	}

	function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}

	function is_image($path)
	{
		if(!file_exists($path))
		{
			return false;
		}

		$a = getimagesize($path);
		$image_type = $a[2];

		if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
		{
			return true;
		}
		return false;
	}

	function FileSizeConvert($path)
	{
		if(!file_exists($path))
		{
			return false;
		}

		$bytes = filesize($path);

		$bytes = floatval($bytes);
		$arBytes = array(
			0 => array(
				"UNIT" => "TB",
				"VALUE" => pow(1024, 4)
				),
			1 => array(
				"UNIT" => "GB",
				"VALUE" => pow(1024, 3)
				),
			2 => array(
				"UNIT" => "MB",
				"VALUE" => pow(1024, 2)
				),
			3 => array(
				"UNIT" => "KB",
				"VALUE" => 1024
				),
			4 => array(
				"UNIT" => "B",
				"VALUE" => 1
				),
			);

		foreach($arBytes as $arItem)
		{
			if($bytes >= $arItem["VALUE"])
			{
				$result = $bytes / $arItem["VALUE"];
				$result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
				break;
			}
		}
		return $result;
	}
	
	function encrypt_url($string) {
	  $key = "EnCrYptedParTOne"; //key to encrypt and decrypts.
	  $result = '';
	  $test = "";
	  for($i=0; $i<strlen($string); $i++) {
	  	$char = substr($string, $i, 1);
	  	$keychar = substr($key, ($i % strlen($key))-1, 1);
	  	$char = chr(ord($char)+ord($keychar));

	  	$test[$char]= ord($char)+ord($keychar);
	  	$result.=$char;
	  }

	  return urlencode(base64_encode($result));
	}

	function decrypt_url($string) {
		$key = "EnCrYptedParTOne"; //key to encrypt and decrypts.
		$result = '';
		$string = base64_decode(urldecode($string));
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}

	function createDir($path)
	{
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		return $path;
	}

	function check_files($name,$redirect,$size,$allowed){
		$ci = &get_instance();
		$ext = pathinfo($_FILES[$name]['name'],PATHINFO_EXTENSION);
		if(! in_array($ext,$allowed)){				
			$ci->session->set_flashdata('danger_message', 'File type not allowed !!');
			redirect(admin_dir().this_module().$redirect);
			exit();
		}
		$filesize = filesize($_FILES[$name]['tmp_name']);
		$min_size = $size[0] * 1024;
		$max_size = $size[1] * 1024;
		if ($filesize < $min_size ){
			$ci->session->set_flashdata('danger_message', 'File terlalu kecil !!');
			redirect(admin_dir().this_module().$redirect);
			exit();
		}
		if ($filesize > $max_size){
			$ci->session->set_flashdata('danger_message', 'File terlalu besar !!');
			redirect(admin_dir().this_module().$redirect);
			exit();
		}

	}

	function file_upload($folder, $field ,$thumb_size="",$crop=''){
		createDir($folder);
		$folder = realpath($folder)."/";

		$name = str_replace(" ", "_", $_FILES[$field]['name']) ;

		$extension = strrchr($name, ".");
		$name = str_replace($extension, "", $name);
		
		$i = 1;
		$newFile = $name . $extension;
		while(file_exists($folder . $newFile)){
			$newFile = $name . '_' . $i . $extension;
			$i++;
		}       

		if (move_uploaded_file($_FILES[$field]['tmp_name'],$folder.$newFile)) {
			if ($thumb_size!="") {
				if ($crop=="all") {
						file_thumb($folder, $newFile, $thumb_size);					
						file_thumb($folder, $newFile, $thumb_size,true);
				}else if ($crop=="crop") {
						file_thumb($folder, $newFile, $thumb_size,true);
					
				}else{
					file_thumb($folder, $newFile, $thumb_size);
				}
			}
			$data =  array('error' => "",'name' => $newFile );
			return $data;
		}else{

			$data =  array('error' => "Error uploading file !!",'name' => $newFile );
			return $data;
		}	
		// $file_type = get_file_extension($_FILES[$field]['name']);
		
	}
	
	function file_thumb($folder , $name , $thumb_size, $crop=FALSE , $fileMode=0644){
		createDir($folder."/thumb");
		$crop_init = ($crop==FALSE) ? "thumb_" : "crop_";
		$CI =& get_instance();
		$CI->load->library(array('image_lib','image_moo'));

		$filename 	   = $folder.$name;
		$thumbFilename = $folder."thumb/".$crop_init.$name;
		$thumb_size    = explode(",", $thumb_size);
		$height        = $thumb_size[0];
		$width         = $thumb_size[1];

		$config['image_library'] = 'gd2';
		$config['source_image']  = $filename;
		$config['create_thumb']	 = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['new_image'] = $thumbFilename;
		$config['quality'] = "100%";
		$config['width']  = $width;
		$config['height'] = $height;
		
        //initialize
		$CI->image_lib->initialize($config);

		if($CI->image_lib->resize()){			
			$CI->image_moo->load($thumbFilename);			
			if ($crop==true) {
                $CI->image_moo->resize_crop($width, $height);				
			}else{
                $CI->image_moo->resize($width, $height);				
			}
            $CI->image_moo->save($thumbFilename,true);
			@chmod($thumbFilename , $fileMode);

		}

	}
	
	function getVersionControl(){
		$string = file_get_contents(FCPATH."version.json");
		$json = json_decode($string, true);
		return $json;
	}
	
	function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}

	function get_substr($string,$value){
		$string = strip_tags($string);
		$value = intval($value);
		if ($value > 0) {
			$dot = (strlen($string)>$value) ? "..." : '';
			$txt = substr($string, 0, $value);
			return $txt.$dot;
		}else if ($value < 0){
			$txt = substr($string, $value);
			$value = abs($value);
			$dot = (strlen($string)>$value) ? "..." : '';
			return $dot.$txt;
		}
	}
	
	function check_version() {
		$local_version = getVersionControl();
		
		exec('git remote -v',$git_name);
		
		if(count($git_name)==0)
			return;	
		
		$git_url_alias = get_string_between($git_name[0],"@bitbucket.org",".git");
		
		exec('git describe --always',$version_mini_hash);
		exec('git rev-list HEAD | wc -l',$version_number);
		exec('git log -1',$line);
		exec('git log -1 --format="%ci"',$last_update);
		exec('git log  --pretty=oneline --format="%ci" | tail -n 1',$first_commit);
		
		if($git_url_alias=="/indoit/indoit-framework-v2-0"){
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
		
		
		$fp = fopen(FCPATH."version.json", 'w');
		fwrite($fp, json_encode($version));
		fclose($fp);

		return $version;
	}

}

?>