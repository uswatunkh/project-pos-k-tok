<?php   
session_start();

function __autoload($class_name) {
	$class_name = strtolower($class_name);
	if(file_exists($class_name . '.php')) {
        require_once($class_name . '.php');    
    } else {
		if(!file_exists('controllers/'.$class_name.'.php')){
			// echo "page not found";
			echo $class_name;
			exit();
	   	}
		
       require_once('./controllers/'.$class_name . '.php'); 
    }
}
function debug($var=''){
	echo "<pre>";
	print_r ($var);
	echo "</pre>";
	exit;
}
$REQUEST_URI_PATH = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$REQUEST_URI_PATH = str_replace($_SERVER['SCRIPT_NAME']."/","",$REQUEST_URI_PATH."/");
$segments = explode('/',$REQUEST_URI_PATH);

//print_r($segments);
//	exit();


if(isset($segments[0]) && $segments[0]==""){
	$login = new Login;
	$login->index();
	exit();
}


$_GET['class'] = $segments[0];

$$_GET['class'] = new $_GET['class'];

if(!file_exists('controllers/'.$_GET['class'].'.php')){
	echo "page not found";
	exit();
}


if(isset($segments[1]) && $segments[1]==""){
	$_GET['module'] = "index";
}else{
	$_GET['module'] = $segments[1];
}

$$_GET['class']->$_GET['module']();



?>