<?php

class Core extends Config {
	public $data;
	
	// Function to validate the post data
	function validate_post($data)
	{
		/* Validating the hostname, the database name and the username. The password is optional. */
		return !empty($data['hostname']) && !empty($data['username']) && !empty($data['database']);
	}

	// Function to show an error
	function show_message($type,$message) {
		return $message;
	}
	
	// Function to write the config file
	function write_config($data) {

		// Config path
		$template_path 	= 'assets/database.php';
		$output_path 	= '../application/config/database.php';

		// Open the file
		$database_file = file_get_contents($template_path);

		$new  = str_replace("%HOSTNAME%",$data['hostname'],$database_file);
		$new  = str_replace("%USERNAME%",$data['username'],$new);
		$new  = str_replace("%PASSWORD%",$data['password'],$new);
		$new  = str_replace("%DATABASE%",$data['database'],$new);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	
	public function theme($view,$data=''){
		$this->data = $data;
		$view = $view;
		require_once('./views/base.php');  
	}
	
	public function login_theme($view,$data=''){
		$this->data = $data;
		$view = $view;
		require_once('./views/login.php');  
	}
	
	public function view($view,$data=''){
		require_once('./'.$view.'.php');  
	}
	
	public function safe($str)
	{
		return strip_tags(trim($str));
	}

	public function readJSON($path)
	{
		$string = file_get_contents($path);
		$obj = json_decode($string);
		return $obj;
	}

	public function createFile($string, $path)
	{

		$create = fopen($path, "w") or die("Unable to open file!");
		fwrite($create, $string);
		fclose($create);
		chmod($path, 0644); 		

		return $path;
	}
	
	public function createDir($path)
	{

		if (!file_exists($path)) {
			$old = umask(0);
			mkdir($path, 0775, true);
			umask($old);
		}
		return $path;
	}

	public function label($str)
	{
		$label = str_replace('_', ' ', $str);
		$label = ucwords($label);
		return $label;
	}
	
	public function uri($segment=NULL, $qs=false){
		$uri = $_SERVER['REQUEST_URI'];
		if(!$qs || $segment !== NULL){
			if(strpos($uri, '?')){
				list($uri, $query) = explode('?', $uri);
			}
			if($segment !== NULL){
				if(is_string($segment)){
					if($segment != 'last'){
						return ( strlen($uri) >= strlen($segment) && substr($uri, 0, strlen($segment)) );
					}
				}
				$str = trim($uri, '/');
				$segments = (strpos($str, '/')) ? explode('/', $str) : array($str);
				$ttl = count($segments);
				if(is_string($segment) && $segment == 'last'){
					$seg = array_pop($segments);
				} elseif($segment <= $ttl){
					if($segment < 0) $segment = $ttl - abs($segment) + 1;
					$seg = $segments[$segment-1];
				} else {
					return '';
				}

				return $seg;
			}
		}
		return $uri;
	}
	function deleteDir($dirPath, $deleteParent = true){
		if (!file_exists($dirPath)) {
			return false;
		}
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirPath, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
			$path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname());
		}
		if($deleteParent) rmdir($dirPath);
		return true;
	}    
	
	function getVersionControl(){
		$string = file_get_contents(realpath("../")."/version.json");
		$json = json_decode($string, true);
		return $json;
	}
	
}
