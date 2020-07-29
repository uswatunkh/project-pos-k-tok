<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_auth extends CI_Model {

	public $tables = array();

	public function __construct() {
		parent::__construct();

		//initialize db tables data
		$this->tables = $this->config->item('tables', 'ion_auth');
	}

	function get_groups_all() {
		$sql = 'SELECT ' . $this->tables['groups'] . '.*, count(' . $this->tables['modules'] . '.id) AS jml_role
                FROM ' . $this->tables['groups'] . '
                LEFT JOIN ' . $this->tables['group_privileges'] . ' ON ' . $this->tables['group_privileges'] . '.group_id = ' . $this->tables['groups'] . '.id
                LEFT JOIN ' . $this->tables['modules'] . ' ON ' . $this->tables['modules'] . '.id = ' . $this->tables['group_privileges'] . '.modules_id
                GROUP BY ' . $this->tables['groups'] . '.id';
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_groups_not_sa() {
		$sql = 'SELECT ' . $this->tables['groups'] . '.*, count(' . $this->tables['modules'] . '.id) AS jml_role
                FROM ' . $this->tables['groups'] . '
                LEFT JOIN ' . $this->tables['group_privileges'] . ' ON ' . $this->tables['group_privileges'] . '.group_id = ' . $this->tables['groups'] . '.id
                LEFT JOIN ' . $this->tables['modules'] . ' ON ' . $this->tables['modules'] . '.id = ' . $this->tables['group_privileges'] . '.modules_id
                WHERE ' . $this->tables['groups'] . '.name != "' . $this->config->item('super_admin_group', 'ion_auth') . '"
                GROUP BY ' . $this->tables['groups'] . '.id';
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_modules() {
		$sql = 'SELECT ' . $this->tables['modules'] . '.id, ' . $this->tables['modules'] . '.title,
        ' . $this->tables['modules'] . '.url, ' . $this->tables['modules'] . '.parent 
        FROM ' . $this->tables['modules'] . '
        ORDER BY soft_order ASC';
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_modules_by_id($id) {
		$sql = 'SELECT * FROM ' . $this->tables['modules'] . ' WHERE id = ?';
		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_permissions_by_group_id($id) {
		$sql = 'SELECT * FROM ' . $this->tables['group_privileges'] . ' WHERE groups_id = ?';
		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_module($id) {
		$sql = 'SELECT DISTINCT(modules_id), ' . $this->tables['modules'] . '.title as module_name,
            ' . $this->tables['modules'] . '.url as module_url,
            max(PRIVILEGE) as user_rule
            FROM ' . $this->tables['group_privileges'] . '
            LEFT JOIN ' . $this->tables['modules'] . ' on ' . $this->tables['modules'] . '.id = ' . $this->tables['group_privileges'] . '.modules_id
            WHERE groups_id IN (
                SELECT group_id FROM ' . $this->tables['users_groups'] . ' WHERE user_id = ?
            )
            GROUP BY modules_id';

		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}
	
	function get_module_parent($parent,$id_user) {
		$sql = 'SELECT * FROM (
            SELECT distinct(modules_id),'.$this->tables['modules'].'.id,title,icon, parent,url,support, sort_order,max(PRIVILEGE) as user_rule FROM ' . $this->tables['modules'] . '
            join ' . $this->tables['group_privileges'] . ' ON ' . $this->tables['modules'] . '.id = ' . $this->tables['group_privileges'] . '.modules_id
            WHERE groups_id IN (SELECT group_id FROM ' . $this->tables['users_groups'] . ' WHERE user_id = ' . $id_user . ')
            AND privilege like "_1___"  AND parent='. $parent .' GROUP BY modules_id,'.$this->tables['modules'].'.id,title,icon, parent,url,support, sort_order) as q 
            ORDER BY sort_order';

		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}
	
	function get_module_by_url($module_url) {
		$sql = "SELECT * FROM ".$this->tables['modules']." where url='".$module_url."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}
	
	function get_module_by_parent($parent) {
		$sql = "SELECT * FROM ".$this->tables['modules']." where id='".$parent."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}
	
	function get_modules_url($params) {
		$sql = 'SELECT DISTINCT(modules_id),' . $this->tables['modules'] . '.title as module_name,
            ' . $this->tables['modules'] . '.url as module_url,GROUP_CONCAT(privilege SEPARATOR ",") as user_privilege
            FROM ' . $this->tables['group_privileges'] . '
            LEFT JOIN ' . $this->tables['modules'] . ' on ' . $this->tables['modules'] . '.id = ' . $this->tables['group_privileges'] . '.modules_id
            WHERE groups_id IN (
                SELECT group_id FROM ' . $this->tables['users_groups'] . ' WHERE user_id = ?
            )
            AND ' . $this->tables['modules'] . '.url = ?
            GROUP BY modules_id';

		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_options($params) {
		$sql = 'SELECT * FROM wd_options WHERE name = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_users_not_sa() {
		$sql = 'SELECT DISTINCT(user_id), ' . $this->tables['users'] . '.*
        FROM ' . $this->tables['users_groups'] . '
        JOIN ' . $this->tables['users'] . ' ON ' . $this->tables['users'] . '.id = ' . $this->tables['users_groups'] . '.user_id
        JOIN ' . $this->tables['groups'] . ' ON ' . $this->tables['groups'] . '.id = ' . $this->tables['users_groups'] . '.group_id
        WHERE user_id NOT IN (
            SELECT user_id
            FROM ' . $this->tables['users_groups'] . '
            JOIN ' . $this->tables['users'] . ' ON ' . $this->tables['users'] . '.id = ' . $this->tables['users_groups'] . '.user_id
            JOIN ' . $this->tables['groups'] . ' ON ' . $this->tables['groups'] . '.id = ' . $this->tables['users_groups'] . '.group_id
            WHERE ' . $this->tables['groups'] . '.name = "' . $this->config->item('super_admin_group', 'ion_auth') . '"
        )';
		return $this->db->query($sql);
	}

	function get_groups_only_and_where_not_sa() {
		$sql = 'SELECT *
                FROM ' . $this->tables['groups'] . '
                WHERE name != "' . $this->config->item('super_admin_group', 'ion_auth') . '"';
		return $this->db->query($sql);
	}

	function identityUpdate($identity) {
		$this->db->where('name', 'identity');
		$update = $this->db->update($this->tables['options'], $identity);
		return $update;
	}
}
