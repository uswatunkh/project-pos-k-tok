<?php

class Model
{

    private $host;
    private $user;
    private $password;
    private $database;
    private $sql;

    function __construct()
    {
        $this->connection();
    }

    function connection()
    {
        $db = file_get_contents('../application/config/database.php');
        $db = explode("\$db['default'] = array(", $db);
        $db = explode(");", $db[1]);
        $db = explode(',', $db[0]);
		
        for ($i = 0; $i < count($db); $i++) {
            $host = explode('=>', $db[$i]);
			
			$key = str_replace(PHP_EOL, '', $host[0]);
			$key = str_replace("'","", $key);
			$key = str_replace(" ","", $key);
            // $key = str_replace("    ","", $key);
			$key = str_replace("\t","", $key);         
			
			$val = str_replace(PHP_EOL,"",$host[1]);
			$val = str_replace("'","",$val);
			$val = str_replace(" ","",$val);
			$val = str_replace("	","",$val);
            $data[$key] = $val;
        }       
        $this->host = $data["hostname"];
		$this->user = $data["username"];
        $this->password = $data["password"];
        $this->database = $data["database"];

        $this->sql = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->sql->connect_error) {
            echo $this->sql->connect_error . ", please check 'application/config/database.php'.";
            die();
        }
    }

	function get_data($query="")
    {
		$result = $this->sql->query($query) OR die("Error code :" . $this->sql->errno . " (get data error)");
     	$fields = null;
		while($row = $result->fetch_array())
		{
			$fields[] = $row;
		}
		
        return $fields;
        $this->sql->close();
    }
	
	function get_last_sort_order()
    {
        $query = "SELECT max(SORT_ORDER) as max FROM wd_modules";
        $result = $this->get_data($query);
		
		if(count($result)>0){
			return $result[0]["max"];
		}
		
		return false;
    }
	
	function modules_check($url)
    {
        $query = "SELECT id FROM wd_modules where url='".$url."'";
        $result = $this->get_data($query);
		
		if(count($result)>0){
			return $result[0]["id"];
		}
		
		return false;
    }
	
	function group_privileges_check($module_id)
    {
        $query = "SELECT id FROM wd_group_privileges where modules_id='".$module_id."' and groups_id='1'";
        $result = $this->get_data($query);
		
		if(count($result)>0){
			return true;
		}
		
		return false;
    }
	
	function ddl($query="")
    {
        $result = $this->sql->query($query) 
        OR die(json_encode(array('type'=>'failure', 'message'=>"Error code :" . $this->sql->errno . " (ddl error)")));
        // OR die("Error code :" . $this->sql->errno . " (dll error)");
     	
        return true;
		$this->sql->close();
    }
	
	function dml($query="")
    {
        $result = $this->sql->query($query) 
        OR die(json_encode(array('type'=>'failure', 'message'=>"Error code :" . $this->sql->errno . " (dml error)")));
        // ("Error code :" . $this->sql->errno . " (dml error)");
     	
        return true;
		$this->sql->close();
    }
	
	function table_check($table)
    {
		$query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='".$this->database."' and TABLE_NAME='".$table."'";
        $result = $this->get_data($query);
		
		if(count($result)>0){
			return true;
		}
		
		return false;
    }

    function multi($query){
        $this->sql->multi_query($query);
        $this->sql->close();
        return true;

    }
	
    function table_list()
    {
        $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=?";
        $result = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $result->bind_param('s', $this->database);
        $result->bind_result($table_name);
        $result->execute();
        while ($result->fetch()) {
            $fields[] = array('table_name' => $table_name);
        }
        return $fields;
        $result->close();
        $this->sql->close();
    }

    function primary_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=? AND COLUMN_KEY = 'PRI'";
        $result = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (primary_field)");
        $result->bind_param('ss', $this->database, $table);
        $result->bind_result($column_name, $column_key);
        $result->execute();
        $result->fetch();
        return $column_name;
        $result->close();
        $this->sql->close();
    }

    function not_primary_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=? AND COLUMN_KEY <> 'PRI'";
        $result = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $result->bind_param('ss', $this->database, $table);
        $result->bind_result($column_name, $column_key, $data_type);
        $result->execute();
        while ($result->fetch()) {
            $fields[] = array('column_name' => $column_name, 'column_key' => $column_key, 'data_type' => $data_type);
        }
        return $fields;
        $result->close();
        $this->sql->close();
    }

    function all_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=?";
        $result = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $result->bind_param('ss', $this->database, $table);
        $result->bind_result($column_name, $column_key, $data_type);
        $result->execute();
        while ($result->fetch()) {
            $fields[] = array('column_name' => $column_name, 'column_key' => $column_key, 'data_type' => $data_type);
        }
        return $fields;
        $result->close();
        $this->sql->close();
    }

}

?>