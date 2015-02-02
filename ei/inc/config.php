<?
	if(is_readable('../../includes/config.php')){
		$prefix = '../';
	}
$prefix = '';
	include "$prefix../includes/config.php";

	$INCLUDES_DIR = "$prefix../includes/";
	$CLASSES_DIR = "$INCLUDES_DIR/clases/";
	$SESSIONS_DIR = "$prefix../sessions/";
	$UPLOADS_DIR = "$prefix../uploads/";

	$smarty_compiled_dir = "$prefix../smarty_tmp/compiled";
	$smarty_cache_dir = "$prefix../smarty_tmp/cache";
	$smarty_configs_dir = "$prefix../smarty_tmp/configs";

	$autologin_cookie_name = $site_name.'_autologin_admin';
	$autologin_cookie_time = (3600 * 24 * 30 * 12); // 1 año

	$main_language = 1;
	$pager_num_items = 20;

	$webmaster = "Conceptovisual";
	$domain_webmaster = "http://www.conceptovisualweb.com";

	// override rules

