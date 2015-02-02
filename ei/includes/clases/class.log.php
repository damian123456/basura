<?php
define('LOG_LEVEL_DEBUG',1);
define('LOG_LEVEL_INFO',2);
define('LOG_LEVEL_WARN',3);
define('LOG_LEVEL_ERROR',4);
define('LOG_LEVEL_FATAL',5);

class Log {
	private $db = null;

	public function __construct(){
		global $db;

		if(!$db){
			return;
		}
		$this->db = $db;
	}

	// Completar
	/*
	 * Log levels:
	 *
	*/
	public function log($module, $message, $level=LOG_LEVEL_INFO) {
		global $user;
		if($user && $user->isValid()){
			$id_user = intval($user->getId());
		} else {
			$id_user = 0;
		}
		$level = intval($level);

		$module = $this->db->escape_string($module);
		$message = $this->db->escape_string($message);
		$ip = $this->db->escape_string($_SERVER['REMOTE_ADDR']);
		$useragent = $this->db->escape_string($_SERVER['HTTP_USER_AGENT']);
		$request_uri = $this->db->escape_string($_SERVER['REQUEST_METHOD'].': '.$_SERVER['REQUEST_URI']);

		$this->db->insert("
			INSERT INTO log SET
				id_user=$id_user,
				level=$level,
				module='$module',
				message='$message',
				ip='$ip',
				useragent='$useragent',
				request_uri='$request_uri'
		");
	}

}
