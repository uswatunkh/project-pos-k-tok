<?php

//  Diambil dari https://github.com/rattrap/codeigniter-layout
// * Khoiruddin *

class Layout {
	private $ci;

	// the title for the layout
	private $layout_title;

	// the meta description for the layout
	private $meta_desc;

	// title separator
	// you can change this in the construct
	public $title_separator;

	// holds the css and js files
	private $includes;
	public function __construct() {
		$this->ci = &get_instance();
		$this->layout_title = NULL;
		$this->meta_desc = NULL;
		$this->title_separator = '';
		$this->includes = array();
	}

	public function set_title($title = NULL) {
		$this->layout_title = $title;
	}

	public function set_desc($meta = NULL) {
		$this->meta_desc = $meta;
	}

	
	public function set_include($type, $file, $options = NULL, $prepend_base_url = TRUE) {
		
		
		if($type=='inline'){
			$this->includes[$type][] = array('file' => $file, 'options' => $options);
		}	
		else
		{	
			if ($prepend_base_url) {
				// $this->ci->load->helper('url');
				$file = $this->ci->config->item('assets') . $file;
			}
			
			$this->includes[$type][] = array('file' => $file, 'options' => $options);	
		}

		// allows chaining
		return $this;
	}
	
	public function theme($theme_folder, $layout, $data = null) {

		// get the contents of the view and store it
		$data['view'] = $layout;
		$view = $this->ci->load->view('templates/'.$theme_folder.'/base', $data, TRUE);

		// set the title
		$title = '';
		// jika bukan home
		if ($this->layout_title !== NULL && $this->ci->uri->segment(1)!== NULL) {
			$title = "Data ".$this->layout_title . $this->title_separator;

			// jika home

		} elseif ($this->layout_title !== NULL && $this->ci->uri->segment(1)==NULL) {
			$title = $this->layout_title;
		}

		// set the meta
		$meta = '';
		if ($this->meta_desc !== NULL) {
			$meta = $this->meta_desc;
		} else {
			$meta = 'Indonesiait';
		}

		$this->ci->load->view('templates/'.$theme_folder . '/base', array('layout_title' => $title, 'meta_desc' => $meta, 'layout_includes' => $this->includes, 'layout_content' => $view));
	}
	
	
	public function set_include_group($group) {
		switch ($group){
			case "index" :
				$this->set_include('css', 'AdminLTE/plugins/datatables/dataTables.bootstrap.css');
				$this->set_include('css', 'AdminLTE/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css');

				$this->set_include('css', 'AdminLTE/plugins/datatables/extensions/export/buttons.dataTables.min.css');
				$this->set_include('css', 'AdminLTE/plugins/datatables/extensions/export/buttons.bootstrap.min.css');

				$this->set_include('css', 'AdminLTE/wd_custom/datatables.css');

				$this->set_include('js', 'AdminLTE/plugins/datatables/jquery.dataTables.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/dataTables.bootstrap.js');
				$this->set_include('js', 'AdminLTE/plugins/datatable-responsive/datatables.responsive.min.js');

				$this->set_include('js', 'AdminLTE/js/datatables.colsearch.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/extensions/export/dataTables.buttons.min.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/extensions/export/buttons.bootstrap.min.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/extensions/export/jszip.min.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/extensions/export/pdfmake.min.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/extensions/export/vfs_fonts.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/extensions/export/buttons.html5.min.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/extensions/export/buttons.print.min.js');
				$this->set_include('js', 'AdminLTE/plugins/datatables/extensions/export/buttons.colVis.min.js');
				break;
			case "form" :
				
				$this->set_include('js','AdminLTE/plugins/daterangepicker/daterangepicker.js');
				$this->set_include('js','AdminLTE/plugins/datepicker/bootstrap-datepicker.js');
				$this->set_include('js','AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
				
				$this->set_include('css', 'AdminLTE/plugins/select2/select2.css');
				$this->set_include('js', 'AdminLTE/plugins/select2/select2.full.min.js');

				$this->set_include('css', 'AdminLTE/plugins/iCheck/all.css');
				$this->set_include('js', 'AdminLTE/plugins/iCheck/icheck.min.js');

				$this->set_include('js', 'ckeditor/ckeditor.js');

				$this->set_include('css','AdminLTE/plugins/datepicker/datepicker3.css');
				$this->set_include('js','AdminLTE/plugins/datepicker/bootstrap-datepicker.js');
				$this->set_include('js','AdminLTE/plugins/jQueryForm/jquery.form.js');
				
				$this->set_include('css','ladda/ladda.min.css');
				$this->set_include('js','ladda/spin.min.js');
				$this->set_include('js','ladda/ladda.min.js');
				$this->set_include('js','ladda/custom.js');
				break;
			
			case 'confirm':
				$this->set_include('js','jquery_confirm/js/jquery-confirm.js');
				$this->set_include('css','jquery_confirm/css/jquery-confirm.css');
				
				break;
			default:
				break;
		}
	}
}

/* End of file layout.php */

/* Location: ./application/libraries/layout.php */
