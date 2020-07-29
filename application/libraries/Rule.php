<?php

/*
Mudah-mudahan bermanfaat,
Pembuatan library ini terinspirasi dari dari TE Framework (CISmart v3.0) dengan beberapa perbedaan
Masih banyak sekali kekurangan, silahkan dikembangkan :)
khoiruddin.com
 */
class Rule {
	private $CI;

	function __construct() {
		$this->CI = get_instance();
		$this->CI->load->library('ion_auth');
		$this->CI->load->model('m_auth');

		//initialize db tables data
		$this->CI->tables = $this->CI->config->item('tables', 'ion_auth');
	}

	//function yang sama dengan in_array, namun ini multidimensi
	//https://www.namepros.com/threads/php-in_array-for-multidimensional-arrays.711084/
	public function multi_in_array($value, $arr2ay) {
		foreach ($arr2ay AS $item) {
			if (!is_array($item)) {
				if ($item == $value) {
					return true;
				}
				continue;
			}

			if (in_array($value, $item)) {
				return true;
			} else if ($this->multi_in_array($value, $item)) {
				return true;
			}
		}
		return false;
	}

	protected function array_multi_sum($arr2ay, $property) {
		$total = '';
		foreach ($arr2ay as $key => $value) {
			if (is_array($value)) {
				$total += $this->array_multi_sum($value, $property);
			} else if ($key == $property) {
				$total += $value;
			}
		}
		return $total;
	}

	public function type($rule = '') {

		//cek url
		$url = $this->CI->security->xss_clean($this->CI->uri->segment(2));

		//user id
		$user = $this->CI->ion_auth->user()->row();
		if (!$this->CI->ion_auth->logged_in()) {
			$user_id = '';
		} else {
			$user_id = $user->id;
		}

		//ambil role dan rule
		$role_rule = $this->CI->m_auth->get_module($user_id);

		//jika user belum login/masuk
		if (!$this->CI->ion_auth->logged_in()) {

			//redirect them to the login page
			redirect('login', 'refresh');
		} elseif

		//jika tidak punya hak/authority dalam ole ini
		(!$this->multi_in_array($url, $role_rule)) {
			//jika tidak memiliki authority
			show_404();
		} else {

			//cari rule berdasarkan dari variable $url
			$params = array($user_id, $url);
			$rule_url = $this->CI->m_auth->get_modules_url($params);

			
			//menjadikan field user_role array CRUD
			foreach ($rule_url as $row) {
				//user rule dalam per role, dipisahkan dengan koma
				$user_rule = $row['user_privilege'];
			}

			//menjadikan array 2 dimensi per role
			$arr2ayMulti = array_map(function ($_) {
				return str_split($_);
			}, explode(',', $user_rule));
			
			

			//menjumlahkan array multi,
			//array ke 0 / Admin
			$total1 = $this->array_multi_sum($arr2ayMulti, '0');

			//array ke 1 / Read
			$total2 = $this->array_multi_sum($arr2ayMulti, '1');

			//array ke 2 / Create
			$total3 = $this->array_multi_sum($arr2ayMulti, '2');

			//array ke 3 / Update
			$total4 = $this->array_multi_sum($arr2ayMulti, '3');
			
			//array ke 4 / Delete
			$total5 = $this->array_multi_sum($arr2ayMulti, '4');

			
			//logical yang simple, pahamlah kamu
			if ($total1 != '0') {
				$n1 = '1';
			} else {
				$n1 = '0';
			}
			if ($total2 != '0') {
				$n2 = '1';
			} else {
				$n2 = '0';
			}
			if ($total3 != '0') {
				$n3 = '1';
			} else {
				$n3 = '0';
			}
			if ($total4 != '0') {
				$n4 = '1';
			} else {
				$n4 = '0';
			}
			if ($total5 != '0') {
				$n5 = '1';
			} else {
				$n5 = '0';
			}

			//hasil logical
			$user_rulesOK = $n1 . $n2 . $n3 . $n4 . $n5;
		

			//menjadikan array dari hasil logical
			$rules = array('A' => substr($user_rulesOK, 0, 1), 'R' => substr($user_rulesOK, 1, 1),'C' => substr($user_rulesOK, 2, 1), 'U' => substr($user_rulesOK, 3, 1), 'D' => substr($user_rulesOK, 4, 1));
			$this->CI->data['privilege'] = $rules;
			
			//jika permission yang diminta tidak ada (misal 'C' tidak ada)
			if (!array_key_exists($rule, $rules)) {
				
				//makan ke halaman error
				show_404();
			} else {

				//atau jika permission di database/field user_rule tidak sama dengan 1 (misal 'C' != 1)
				if ($rules[$rule] != '1') {

					//maka ke halaman error
					show_404();
				}

				//jika berhasil melewati semua rintangan yang menghadang,
				//maka disinilah halaman dimunculkan tanpa di redirect ke show_404();
			}
		}
	}
	
	public $active_menu = array();
	function active_menu($url){
		$this->active_menu = array();
		$this->generate_active_menu($url);
		return $this->active_menu;
	}
	
	
	function generate_active_menu($module_url,$parent=''){
		if($parent==''){
			$data_module = $this->CI->m_auth->get_module_by_url($module_url);
		}
		else{
			$data_module = $this->CI->m_auth->get_module_by_parent($parent);	
		}
		
		foreach($data_module as $row){
			$this->active_menu[]['url'] = $row['id'];
			$this->generate_active_menu('',$row['parent']);
		}
	}
	
	public $sidebar = "";
	function sidebar_menu(){
		$this->sidebar = '';
		$this->generate_sidebar_menu();
		return $this->sidebar;
	}
	
	function generate_sidebar_menu($id_parent='0') {
		$user = $this->CI->ion_auth->user()->row();
		$module_url = $this->CI->security->xss_clean($this->CI->uri->segment(2));
		
		$data_module = $this->CI->m_auth->get_module_parent($id_parent,$user->id);
		foreach($data_module as $rows){
			$class = "";
			$pull = "";
			$sub_data_module = $this->CI->m_auth->get_module_parent($rows['id'],$user->id);
			
			if(count($sub_data_module)>0){
				$class= 'treeview';
				
				$pull= '<i class="fa fa-angle-left pull-right"></i>';
			}
			
			$active=$this->active_menu($module_url);
			foreach($active as $active_row){
				if($rows['id']==$active_row['url']){
					$class .= ' active';
				}
			}
			
				$this->sidebar .=
				'<li class="'.$class.'">
					<a href="'.backend_url().$rows['url'].'">
						<i class="'.$rows['icon'].'"></i><span>'.$rows['title'].'</span> '.$pull.'
					</a>';
					
			
					if(count($sub_data_module)>0){
						
						$this->sidebar .= '
						<ul class="treeview-menu">
						';
						
							$this->generate_sidebar_menu($rows['id']);
						
						$this->sidebar .= '
						</ul>
						';
					}
						
				$this->sidebar .=
				'</li>';
		}
	}

}

/* End of file rule.php */

/* Location: ./application/libraries/rule.php */
