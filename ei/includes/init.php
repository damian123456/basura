<?
	if (PHP_SAPI !== 'cli'){
		unset($_REQUEST);
		$_REQUEST = array();

		if(is_array($_GET)) $_REQUEST = $_GET;
		if(is_array($_POST)) $_REQUEST = array_merge($_REQUEST,$_POST);
	}

	include 'config.php';
	include 'funciones.php';
	header("Content-Type: text/html; charset=$charset");

	include 'handle_forms.php';
