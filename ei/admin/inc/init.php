<?
	if (PHP_SAPI !== 'cli'){
		unset($_REQUEST);
		$_REQUEST = array();

		if(is_array($_GET)) $_REQUEST = $_GET;
		if(is_array($_POST)) $_REQUEST = array_merge($_REQUEST,$_POST);
	}

	include 'config.php';
	//include "{$INCLUDES_DIR}funciones.php";
	include '../includes/funciones.php';
	header("Content-Type: text/html; charset=$charset");

	session_start();
	if(!$_SESSION["panel"] && !$isLogin){
		redirect("login.php?action=login");
	}

