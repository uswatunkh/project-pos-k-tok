<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_backend
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->lang->load('auth');
		$this->load->model(array('dashboard_m'));

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->layout->set_title("Dashboard");
	}

	public function index()
	{

		check_version();

		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Dashboard');

		$this->data['primary_title'] = '<i class="fa fa-dashboard"></i> Dashboard';
		$this->data['sub_primary_title'] = '';

		$this->data['user_registrations'] = $this->db->get('wd_users')->num_rows();
		$this->data['wd_modules'] = $this->db->get('wd_modules')->num_rows();
		$this->data['latest_login'] = $this->admin_latest_login();
		$this->data['record_in_db'] = $this->dashboard_m->getRecord();
		$this->data['record_in_table'] = $this->dashboard_m->getRecordPerTable();
		$this->data['online'] =  $this->db->select('*')->from('online_users')->get()->num_rows();

		// flot chart
		$this->layout->set_include('js', 'AdminLTE/plugins/flot/jquery.flot.min.js');
		$this->layout->set_include('js', 'AdminLTE/plugins/flot/jquery.flot.resize.min.js');
		$this->layout->set_include('js', 'AdminLTE/plugins/flot/jquery.flot.pie.min.js');
		$this->layout->set_include('js', 'AdminLTE/plugins/flot/jquery.flot.categories.min.js');
		$this->layout->set_include('js', 'AdminLTE/plugins/chartjs/Chart.min.js');


		$this->layout->set_include('inline', getview('index_js', $this->data));
		$this->layout->theme('backend', 'v_dashboard', $this->data);
	}

	protected function admin_latest_login()
	{
		$id = $this->session->userdata();
		$user_id = $id['user_id'];
		$query = $this->dashboard_m->role($user_id);

		//jika user adalah superadmin
		if ($query > 0) {
			//tampilkan semua data admin last login termasuk superadmin
			$this->data['get_users'] =  $this->dashboard_m->where_superadmin();
		} else {
			//tampilkan semua data admin last_login kecuali superadmin
			$this->data['get_users'] =  $this->dashboard_m->where_not_superadmin();
		}

		return $this->data['get_users'];
	}
}
