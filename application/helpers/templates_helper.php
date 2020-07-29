<?php
if ( ! function_exists('element')) {
	
	function getview($view,$data=null) {
        $ci = &get_instance();
        return $ci->load->view($view,$data,true);
    }
}

?>