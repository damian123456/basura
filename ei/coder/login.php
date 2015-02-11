<?php
ob_start();
error_reporting(FALSE);
if( !ini_get('safe_mode') ){
            set_time_limit(60);
}
ignore_user_abort(TRUE);
define('vinaget', 'yes');
include("config.php");
date_default_timezone_set('Asia/indonesia');

if ($_GET['go']=='logout') {
	setcookie("secureid", "owner", time());
	setcookie("pass", "owner",time());
	echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=./">';
} 
else {
	foreach ($SecureID as $login_vng)
	if(($_POST['secure'] == $login_vng))
	{
	setcookie("secureid",md5($login_vng),time()+3600*24*7);
	echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=./">';
	}else{
	echo ("<SCRIPT language='Javascript'>alert(\"Enter the correct password !\");</SCRIPT><SCRIPT language='Javascript'> history.go(-1)</SCRIPT>");
	}

}
ob_end_flush();
?>
