<?php defined('BASEPATH') or exit('No direct script access allowed');

class Theme extends MY_backend
{
    function __construct()
    {
        parent::__construct();


        //library breadcrum/untuk navigasi
        $this->load->library('breadcrumb');
        $this->load->library('urlcrypt');

        //breadcrumb untuk navigasi
        $this->breadcrumb->add_crumb('Home');
        $this->breadcrumb->add_crumb('Options');

        $this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Options';
        $this->data['sub_primary_title'] = '';

        $this->data['sub_title'] = 'Theme';
        $this->layout->set_title($this->data['sub_title']);

        $this->table_wd_options = 'wd_options';
    }

    // {VIEW} //
    function index()
    {
        $this->rule->type('R');

        $this->layout->set_include_group('form');
        $this->data['theme'] = $this->wd_db->get_data($this->table_wd_options, array('name' => 'theme'));
        $this->data['layout'] = $this->wd_db->get_data($this->table_wd_options, array('name' => 'layout'));
        $this->data['sidebar'] = $this->wd_db->get_data($this->table_wd_options, array('name' => 'sidebar'));


        $this->layout->set_include('inline', getview('index_js', $this->data));
        $this->layout->theme('backend', 'index', $this->data);
    }

    function save_action()
    {
        $this->rule->type('C');

        $data = array(
            'value' => $this->input->post('theme'),
        );
        $where = array('name' => "theme");
        $this->wd_db->edit_dml($this->table_wd_options, $data, $where);


        $data = array(
            'value' => $this->input->post('layout'),
        );
        $where = array('name' => "layout");
        $this->wd_db->edit_dml($this->table_wd_options, $data, $where);

        $data = array(
            'value' => $this->input->post('sidebar'),
        );
        $where = array('name' => "sidebar");
        $this->wd_db->edit_dml($this->table_wd_options, $data, $where);

        redirect(admin_dir() . this_module() . '');
    }
}
