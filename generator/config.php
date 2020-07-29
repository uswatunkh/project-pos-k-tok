<?php

class Config {
	public $data;
	
	public function session_timeout() {
		$session_timeout = "600"; // in second
		return $session_timeout;
    }
	
	public function base_url() {
      	$url_path = "http://"; 
		$url_path .= $_SERVER['SERVER_NAME']."";
		$url_path .= str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);

		return $url_path;
    }
	
	public function core_url($var="") {
      	$url_path = "http://"; 
		$url_path .= $_SERVER['SERVER_NAME']."";
		$url_path .= str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);
		
		$url_path = str_replace("generator/", "", $url_path);

		return $url_path.$var;
    }
	
}
 





