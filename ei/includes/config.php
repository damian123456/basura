<?

	/*
	 ______________________
	|                      |
	|    CONFIGURACIÓN     |
	|______________________|

	*/

	ini_set('display_errors','off');

	$debug = $offline = $local = $speedy = false;
	$idioma= "ES_es";
	$charset = 'utf-8';

	//acceso a la base de datos
	$db_host	=	'localhost';
	//$db_usuario	=	'educaidiom_site';
	//$db_usuario_admin	=	'educaidiom_site';
        $db_usuario	=	'educaidio_user';
	$db_usuario_admin	=	'educaidio';
	
	//$db_pass	=	'in7XCOBb';
        $db_pass	=	'flemita1';
	$db_base	=	'educaidio_db';

	preg_match("/(educaidiomas\.com|educa\.dev|prueba\.dev|localhost|\d+\.\d+\.\d+\.\d+)/",$_SERVER['HTTP_HOST'],$matches);
	if(preg_match("/\d+\.\d+\.\d+\.\d+/",$matches[1])){
		$dominio = 'localhost';
	} else {
		$dominio = $matches[1];
	}

	$config = array(
		'mailer' => 'mail',
		'smtp_host' => '',
		'smtp_port' => '',
		'smtp_auth' => false,
		'smtp_user' => '',
		'smtp_password' => ''
	);

	switch($dominio){
		case "educa.dev":
		case "prueba.dev":
		case "localhost":
			$local = true;
			$db_usuario	=	'root';
			$db_pass	=	'pacotilla';
			$db_base	=	'educa';

			$debug = true;
			$offline = true;
			$ip_user = $_SERVER['REMOTE_ADDR'];
			if($dominio=='localhost'){
				$base = "http://".$matches[1]."/educa/";
			} else {
				$base = "http://www.".$dominio."/";
			}
			break;
		default:
			$debug = true;
			if($admin) $db_usuario = $db_usuario_admin;
			$dominio = "educaidiomas.com.ar";
			$base = "http://educaidiomas.com.ar";
			$speedy = true;
			$ip_user = $_SERVER['HTTP_X_REAL_IP'];
	}

	define('DEBUG',$debug);
	define('OFFLINE',$offline);


	$url_actual = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

	require_once 'clases/class.db.php';
	$db = new SQL($db_host,$db_usuario,$db_pass,$db_base,'mysql',$charset);
	//var_dump($db);
	// Configuraciones generales
	$nombre_sitio = "EducaIdiomasOnline";
	$tel_contacto = "";
	$nombre_contacto = "EducaIdiomasOnline.com";
	$mail_contacto = "cursos@educaidiomasonline.com";
	//$mail_contacto = "hola@conceptovisualweb.com";
	$mail_clientes = "cursos@educaidiomasonline.com";
	//$mail_templates_dir = "mails/";

	$autologin_cookie_name = $nombre_sitio.'_autologin';
	$autologin_cookie_time = (3600 * 24 * 30 * 12); // 30 days
	$autologin_salt = 'hdla834$jza<<$!';

	//$cache_dir = 'cache/';
	//$config['compresion_gzip'] = true;
	//$config['cache'] = false;

	$INCLUDES_DIR = "includes/";
	$UPLOADS_DIR = "uploads/";

	$autologin_cookie_name = $site_name.'_autologin_admin';
	$autologin_cookie_time = (3600 * 24 * 30 * 12); // 1 año

	$main_language = 1;
	$pager_num_items = 20;

	// override rules
	
	$conf_vals = $db->fetch_all("SELECT * FROM config",'valor','atributo');
	if(is_array($conf_vals)){
		$config = array_merge($config,$conf_vals);
	}

