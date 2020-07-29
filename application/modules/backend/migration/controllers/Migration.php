<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration extends MY_backend
{
	function __construct()
	{
		parent::__construct();

		$this->allowed_types = array('sql');
		$this->file_size = array(0, 20000);

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');

		$this->load->library('zip');
		$this->load->helper('file');

		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Migration');

		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Migration';
		$this->data['sub_primary_title'] = '';

		$this->data['sub_title'] = 'Migration';
		$this->layout->set_title($this->data['sub_title']);

		$this->table_migration = 'institusi';

		$this->validation_rule();
	}

	// {VIEW} //
	function index()
	{
		$this->rule->type('R');

		$this->layout->set_include_group('index');
		$this->layout->set_include('inline', getview('index_js', $this->data));
		$this->data["db_file"] = $this->get_db_file();
		$this->layout->theme('backend', 'index', $this->data);
	}

	function show()
	{
		$this->rule->type('R');
		$id = $this->urlcrypt->decode($this->input->get('id'));

		$this->layout->set_include_group('form');
		$this->layout->set_include('inline', getview('form_js'));

		$this->data['list'] = $this->wd_db->get_data_row($this->table_migration, array('id' => $id));

		$this->layout->theme('backend', 'show', $this->data);
	}

	// {VALIDATION RULE} //
	public function validation_rule()
	{
		$this->data['rules'] = array(
			array('field'   => 'mode', 'label' => 'Mode', 'rules'   => 'required')
		);
		$this->data['rules_message'] = array();
	}

	function add()
	{
		array_push($this->data['rules'], array('field'   => 'file_db', 'label' => 'File_db', 'rules'   => 'required'));
		//Run validate with js

		$this->layout->set_include_group('form');
		$this->layout->set_include('inline', getview('form_js'));
		$this->layout->theme('backend', 'add', $this->data);
	}

	// {ACTION} //
	function view()
	{
		$file = $this->uri->segment(4);
		$db_file = "./db/" . $file;

		$lines = file($db_file);
		foreach ($lines as $num => $line) {
			echo $line;
			echo "<br>";
		}
	}

	function save_action()
	{
		$newFile = "./db/" . date('Ymd_His') . "_" . $this->input->post('mode') . "_db.sql";

		if ($this->ci_validation() == FALSE)
			redirect(admin_dir() . this_module() . '/add');


		if (isset($_FILES['file_db']['name']) && $_FILES['file_db']['name'] != '') {
			check_files('file_db', '/add', $this->file_size, $this->allowed_types);

			if (move_uploaded_file($_FILES['file_db']['tmp_name'], $newFile) == false) {
				$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir() . this_module() . '/add');
				exit();
			}
		}


		$this->session->set_flashdata('success_message', 'New database file created successfully');
		redirect(admin_dir() . this_module());
	}

	function restore()
	{
		$file = $this->uri->segment(4);
		$db_file = "./db/" . $file;

		$file_date = substr($file, 0, 4) . "-" . substr($file, 4, 2) . "-" . substr($file, 6, 2) . " " . substr($file, 9, 2) . ":" . substr($file, 11, 2) . ":" . substr($file, 13, 2);
		$file_mode = substr($file, 16, 3);

		$templine = "";
		$lines = file($db_file);

		$prcnt = 100 / count($lines);

		$this->db->query("SET FOREIGN_KEY_CHECKS=0");
		foreach ($lines as $num => $line) {

			if (substr($line, 0, 2) == '--' || $line == '')
				continue;

			$templine .= $line;

			if (substr(trim($line), -1, 1) == ';') {

				if (!$this->db->query($templine)) {
					$this->session->set_flashdata('error_message', 'Error query');
					redirect(admin_dir() . this_module());
				}
				$templine = '';
			}
		}
		$this->db->query("SET FOREIGN_KEY_CHECKS=1");


		$data = array(
			'file' => $file,
			'date' => $file_date,
			'mode' => $file_mode,
			'status' => date('Y-m-d H:i:s')
		);

		$this->wd_db->del_dml_where_in("wd_migration", 'file', $file);
		$this->wd_db->add_dml_get_id("wd_migration", $data);

		$this->session->set_flashdata('success_message', 'File ' . $file . ' execute successfully');
		redirect(admin_dir() . this_module());
	}


	function delete_action()
	{

		if ($this->input->get('confirm') == null) {
			$file = $this->input->post('checkbox');
			$this->data['delete_row'][0] = array("file" => $file[0]);
			$this->data['field_show'] = "file";
			$this->data['table']      = null;
			$this->data["custom"]     = null;
			$this->data["dependenci_table"]     = null;
			$this->data["relation_status"][0]     = "";

			$this->session->set_flashdata('del_id', $file[0]);

			$this->load->view('general_view/delete_modal', $this->data);
			return;
		}

		$del_id = $this->session->flashdata('del_id');

		@unlink("./db/" . $del_id);

		$this->wd_db->del_dml_where_in("wd_migration", 'file', $del_id);
		$this->session->set_flashdata('success_message', 'File ' . $del_id . ' deteled successfully');
		redirect(admin_dir() . this_module());
	}

	public function get_db_file()
	{
		$dir = "./db/";

		$data = [];
		$index = 0;
		// Open a directory, and read its contents
		if (is_dir($dir)) {
			$files = scandir($dir, 1);

			foreach ($files as $file) {
				if ($file != "." && $file != ".." && strlen($file) == 26) {
					$data[$index]['file'] = $file;
					$data[$index]['date'] = substr($file, 0, 4) . "-" . substr($file, 4, 2) . "-" . substr($file, 6, 2) . " " . substr($file, 9, 2) . ":" . substr($file, 11, 2) . ":" . substr($file, 13, 2);
					$data[$index]['mode'] = substr($file, 16, 3);

					$exist = $this->wd_db->get_data_row("wd_migration", array('file' => $file));
					$data[$index]['status'] = "<span class='label label-default'>not sync</span>";
					if ($exist != '') {
						$data[$index]['status'] = "<span class='label label-success'>sync (" . $exist['status'] . ")</span>";
					}

					$index++;
				}
			}
		}

		return $data;
	}

	public function generate_db()
	{
		$this->load->dbutil();

		$name = date('Ymd_His') . "_all_db.sql";
		$prefs = array(
			// 'tables'     => array('table1', 'table2'),
			'ignore'     => 'wd_backup_db',
			'format'     => 'sql',
			'filename'   => $name . '.sql',
			'add_drop'   => TRUE,
			'add_insert' => TRUE,
			'newline'    => "\n"
		);

		write_file("db/" . $name, $this->dbutil->backup($prefs));

		$this->session->set_flashdata('success_message', 'New database file created successfully');
		redirect(admin_dir() . this_module());
	}
}




/* End of file Institusi.php */
/* Location: ./application/modules/institusi/controllers/Institusi.php */
/* Please DO NOT modify this information : */
/* Generated by IndonesiaIT Codeigniter CRUD Generator 2017-03-31 00:57:07 */
/* indonesiait.com */
