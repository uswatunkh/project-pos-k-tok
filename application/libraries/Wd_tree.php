<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Wd_tree {

	function buildTree(array $elements, $parentId = '0') {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['parent'] == $parentId) {
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['sub'] = $children;
				}
				$branch[] = $element;
			}
		}
		return $branch;
	}
	
	function buildArray2(array $elements, $parentId = '0',$sub=0) {
		$branch = array();
		$prefix = '';
		$prefix_front = '-';
		
		for($i=0;$i<$sub;$i++){
			$prefix = $prefix.$prefix_front;
		}
		
		foreach ($elements as $element) {
			if ($element['parent'] == $parentId) {
				
				$sub++;
				$children = $this->buildArray($elements, $element['id'],$sub);
			
				if ($children) {
					
					$element['tree'] = $prefix.$element['title'];
					$element['sub'] = $children;
				}
				
				$element['tree'] = $prefix.$element['title'];
				$sub--;	
				$branch[] = $element;
			}
			
		}
		$sub--;	
		return $branch;
	}
	
	private $tree;
	private $sub;
	
	function buildArray(array $elements,$prefix_front='-') {
		$CI =& get_instance();
		$CI->load->model('wd_db');
		
		$id = $CI->session->userdata();
		$user_id = $id['user_id'];
		
		$super = $CI->wd_db->get_count("wd_users_groups",array("user_id"=>$user_id,"group_id"=>"1"));
		$prefix = ' ';
		
		for($i=0;$i<$this->sub;$i++){
			$prefix = $prefix.$prefix_front;
		}
		
		foreach($elements as $row){
			//echo $prefix.$row['title'];
			
			if($row["only_super"]==1 && $super==0){
				continue;
			}
			
			$icon = "<i class='fa fa-chevron-circle-right'></i>";
			$module_status = "1";
			if(isset($row['sub'])){
				$icon = "<i class='fa fa-chevron-circle-down'></i>";
				$module_status = "0";
			}
			
			$tree = $row;
			$tree['tree'] = "".$prefix.$icon." ".$row['title'];
			$tree['module_status'] =  $module_status;
			
			$tree['sub'] = "";
			
			$this->tree[] = $tree;
			
			if(isset($row['sub'])){
				$this->sub++;
				$this->buildArray($row['sub'],$prefix_front);
			}
			
		}
		$this->sub--;
		$result = $this->tree;
		
		return $result;
	}
	
	function printTree(array $elements,$prefix_front='-',$prefix_back='<br>',$sub=0){
		$prefix = '';
		
		for($i=0;$i<$sub;$i++){
			$prefix = $prefix.$prefix_front;
		}
		
		foreach($elements as $row){
			echo $prefix.$row['title'].$prefix_back;
			if(isset($row['sub'])){
				$sub++;
				$this->printTree($row['sub'],$prefix_front,$prefix_back,$sub);
			}
		}
		$sub--;	
	}
	
	function printTreeOl(array $elements){
		$prefix = '';

		echo "<ul>";
		foreach($elements as $row){
			echo "<li>".$prefix.$row['title']."</li>";
			if(isset($row['sub'])){
				$sub++;
				$this->printTree($row['sub']);
			}
		}
		echo "</ul>";
	}
	
}