<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_index extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function tes(){
		echo "connect";
	}
}





/* End of file M_index.php */
/* Location: ./application/modules/pagemenu/models/M_index.php */
/* Please DO NOT modify this information : */
/* Generated by WD Codeigniter CRUD Generator 2016-08-11 05:26:38 */
/* indonesiait.com */