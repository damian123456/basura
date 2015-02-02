<?php
/////////////////////////////////////////////////////////
// Helper Functions                                    //
function dbunescape($str){
		//return str_replace(array('&gt;','&lt;'),array('>','<'),htmlentities(html_entity_decode(stripslashes($str)),ENT_QUOTES));
	if(get_magic_quotes_gpc())
		return str_replace(array('&gt;','&lt;'),array('>','<'),stripslashes($str));
	else
		return $str;
}
function dbarrayUnescape(&$str){
	$str = dbunescape($str);
}

// Sqlite function sqlite_fetch_array return an associative array with the
// keys formatted like this: table.fieldname
// That's ugly. Here we clean it!
function sqliteCleanFieldnames(&$array){
	foreach ($array as $key => $value) {
		unset($array[$key]);
		$key = substr($key, strpos($key, '.')+1);
		$array[$key] = $value;
	}
	return $array;
}
/////////////////////////////////////////////////////////

class SQL {
	var $engine;
	var $link;
	var $last_res;

	function SQL($server,$user,$pass,$db,$engine='mysqli',$charset='utf8'){
		$this->engine = $engine;
		switch($engine){
			case 'mssql':
				if(!($this->link = @mssql_connect($server,$user,$pass))){
					$this->link = null;
				} else {
					if(!mssql_select_db($db,$this->link)){
						$this->link = null;
					}
				}
				break;
			case 'mysql':
				if(!($this->link = @mysql_connect($server,$user,$pass))){
					$this->link = null;
				} else {
					if(!mysql_select_db($db,$this->link)){
						$this->link = null;
					}
				}
				break;
			case 'mysqli':
				if(!($this->link = @mysqli_connect($server,$user,$pass))){
					$this->link = null;
				} else {
					if(!mysqli_select_db($this->link,$db)){
						$this->link = null;
					}
				}
				break;
			case 'sqlite':
				if(!($this->link = @sqlite_open($server))){
					$this->link = null;
				}
				break;
		}
		$this->query("SET NAMES '$charset'");
		return $this->link;
	}

	function query($sql){
		$this->last_res = null;
		switch($this->engine){
			case 'mssql': $this->last_res = mssql_query($sql,$this->link); break;
			case 'mysql':	$this->last_res = mysql_query($sql,$this->link); break;
			case 'mysqli':
				$this->last_res = null;
				if(mysqli_multi_query($this->link,$sql)){
					$this->last_res = mysqli_store_result($this->link);
				}
				break;
			case 'sqlite': $this->last_res = sqlite_unbuffered_query($this->link,$sql); break;
		}
		return $this->last_res;
	}

	function insert($sql,$norefresh=false){
		global $cache;
		$res = $this->query($sql);
		$ret = $this->insert_id();
		if($ret && is_object($cache) && !$norefresh) $cache->clean();
		return $ret;
	}

	function update($sql,$norefresh=false){
		global $cache;
		$ret = false;
		$res = $this->query($sql);
		$ret = $this->affected_rows();
		if($ret && is_object($cache) && !$norefresh) $cache->clean();
		return $ret;
	}

	function delete($sql,$norefresh=false){
		global $cache;
		$ret = $this->query($sql);
		if($ret && is_object($cache) && !$norefresh) $cache->clean();
		return $ret;
	}

	function fetch_assoc($res){
		$ret = null;
		switch($this->engine){
			case 'mssql':
				$ret = mssql_fetch_assoc($res);
				break;
			case 'mysql':
				$ret = mysql_fetch_assoc($res);
				break;
			case 'mysqli':
				$ret = mysqli_fetch_assoc($res);
				break;
			case 'sqlite':
				$ret = sqlite_fetch_array($res,SQLITE_ASSOC);
				array_walk($ret,'sqliteCleanFieldnames');
				break;
		}
		if(is_array($ret))
			array_walk($ret,'dbarrayUnescape');
		return $ret;
	}

	function fetch_item($sql){
		$ret = null;
		if($res = $this->query($sql)){
			$ret = $this->fetch_assoc($res);
			$this->free_result($res);
		}
		return $ret;
	}

	function fetch_item_field($sql,$field=false){
		if($row = $this->fetch_item($sql)){
			if($field)
				return dbunescape($row[$field]);
			else
				return dbunescape(array_shift($row));
		}
		return null;
	}

	function fetch_all($sql,$field=null,$keyfield=null){
		$items = array();
		if($res = $this->query($sql)){
			while($row = $this->fetch_assoc($res)){
				if($field !== false && $field !== null)
					$value = $row[$field];
				else
					$value = $row;

				if($keyfield !== null)
					$items[$row[$keyfield]] = $value;
				else
					$items[] = $value;
			}
			$this->free_result($res);
			return $items;
		}
		return null;
	}

	function escape_string($str){
		switch($this->engine){
			case 'mssql':
				$ret = str_replace("'","`",$str);
				break;
			case 'mysql':
				$ret = mysql_real_escape_string($str,$this->link);
				break;
			case 'mysqli':
				$ret = mysqli_real_escape_string($this->link,$str);
				break;
			case 'sqlite':
				$ret = sqlite_escape_string($str);
				break;
		}
		return $ret;
	}

	function affected_rows(){
		switch($this->engine){
			case 'mssql':
				$ret = mssql_rows_affected($this->link);
				break;
			case 'mysql':
				$ret = mysql_affected_rows($this->link);
				break;
			case 'mysqli':
				$ret = mysqli_affected_rows($this->link);
				break;
			case 'sqlite':
				$ret = sqlite_changes($this->link);
				break;
		}
		return $ret;
	}

	function num_rows($sql=null){
		if(is_string($sql))
			$res = $this->query($sql);
		else
			$res = $this->last_res;
		$ret = null;
		switch($this->engine){
			case 'mssql':
				$ret = mssql_num_rows($res);
				break;
			case 'mysql':
				$ret = mysql_num_rows($res);
				break;
			case 'mysqli':
				$ret = mysqli_num_rows($res);
				break;
			case 'sqlite':
				$ret = sqlite_num_rows($res);
				break;
		}
		return $ret;
	}

	function insert_id(){
		switch($this->engine){
			case 'mssql':
				$ret = true;
				break;
			case 'mysql':
				$ret = mysql_insert_id($this->link);
				break;
			case 'mysqli':
				$ret = mysqli_insert_id($this->link);
				break;
			case 'sqlite':
				$ret = sqlite_last_insert_rowid($this->link);
				break;
		}
		return $ret;
	}

	function error(){
		switch($this->engine){
			case 'mssql':
				$ret = mssql_get_last_message();
				break;
			case 'mysql':
				$ret = mysql_error($this->link);
				break;
			case 'mysqli':
				if($this->link){
					$ret = mysqli_error($this->link);
				} else {
					$ret = mysqli_connect_error();
				}
				break;
			case 'sqlite':
				if($num = $this->errno()){
					$ret = sqlite_error_string($num);
				} else {
					$ret = '';
				}
				break;
		}
		return $ret;
	}

	function errno(){
		switch($this->engine){
			case 'mssql':
				break;
			case 'mysql':
				$ret = mysql_errno($this->link);
				break;
			case 'mysqli':
				if($this->link){
					$ret = mysqli_errno($this->link);
				} else {
					$ret = mysqli_connect_errno();
				}
				break;
			case 'sqlite':
				$ret = sqlite_last_error($this->link);
				break;
		}
		return $ret;
	}

	function free_result($res){
		switch($this->engine){
			case 'mssql':
				$ret = mssql_free_result($res);
				break;
			case 'mysql':
				$ret = mysql_free_result($res);
				break;
			case 'mysqli':
				$ret = mysqli_free_result($res);
				while(mysqli_next_result($this->link));
				break;
			case 'sqlite':
				$ret = true;
				break;
		}
		return $ret;
	}

	function getTables(){
		foreach($this->fetch_all("SHOW TABLES") as $t){
			$tables_arr[] = array_pop($t);
		}
		return $tables_arr;
	}

	function importSql($file){
		$sql = '';
		$lines = file($file);
		foreach ($lines as $line) {
			$line = trim($line);
			if (substr($line, 0, 2) != '--' && $line!='') {
				$sql .= " $line";
				if (substr($line, -1,1) == ';') {
					$this->query($sql);
					$sql = '';
				}
			}
		}
	}

	function exportSql(){
		$tables_arr = $this->getTables();
		$return = 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

';

		//cycle through the tables
		foreach($tables_arr as $table) {
			$rows = $this->fetch_all('SELECT * FROM '.$table);

			// Drop Table and Create table
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$create = $this->fetch_item('SHOW CREATE TABLE '.$table);
			$return.= "\n".$create['Create Table'].";\n\n";

			// Insert data
			foreach($rows as $row){
				$return.= "INSERT INTO $table VALUES(";
				$fields = array();
				foreach($row as $field){
					$field = $this->escape_string($field);
					if (isset($field)) { $field = "'".$field."'" ; } else { $field = "''"; }
					$fields[] = $field;
				}
				$return.= implode(',',$fields);
				$return.= ");\n";
			}
			$return.="\n\n";
		}
		return $return;
	}
}
