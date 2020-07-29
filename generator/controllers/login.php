<?php

class Login extends Core {
   
	function __construct()
	{
		
	}
	
	public function index() {
    	$data = "";
		
		$this->login_theme('login',$data);
		
	}
	
	public function login() {
		$password = str_replace("'","",$_POST["password"]);
		$password = str_replace('"',"",$password);
		
		if(isset($_SESSION['timeout'])){
			// session_destroy();
			// 10 mins in seconds
			$inactive = $this->session_timeout(); 
			$session_life = time() - $_SESSION['timeout'];

			if($session_life > $inactive)
			{
				$_SESSION['login_user']= null;
				$_SESSION['timeout'] = null;
				session_destroy();
			}else{
				$_SESSION['timeout']=time();
				//session_destroy();
			}
		}
		
		if(isset($_SESSION['wrong'])){
			if($_SESSION['wrong']>=3){
				echo "
				<script>alert('Blocked, because failed login more than 3 times, please wait 10 minutes');window.history.back();</script>
				";
				exit();
			}
		}
		
		if($password=="indoit".date('mY')){
			$_SESSION['login_user']= true; 
			$_SESSION['timeout']=time();
			header("Location: ".$this->base_url()."index.php/install"); 
		}
		else{
			$_SESSION['timeout']=time();
			
			if(!isset($_SESSION['wrong'])){
				$_SESSION['wrong'] = 1;
			}else{
				$_SESSION['wrong'] = $_SESSION['wrong'] + 1;
			}
			
			echo "
			<script>alert('Wrong Autentification Code. ".$_SESSION['wrong']."x');window.history.back();</script>
			";
			exit();
		}
    }
	
	public function logout() {
		$_SESSION['login_user']= null;
		$_SESSION['timeout'] = null;
		session_destroy();
		header("Location: ".$this->base_url()); 
    }
	
}
