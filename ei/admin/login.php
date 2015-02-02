<?
//error_reporting(0);
$isLogin = true;
require_once("inc/init.php");

session_start();
if($_SESSION["panel"]&&!$_GET["action"]) header("Location: index.php");
require_once("../includes/mailer/class.phpmailer.php");

require_once("includes/functions/config.php");
require_once("../includes/config.php");//agregue
$config["page"]["current"] = 2;
$dominio = data("domain");
$support = data("webmaster-email");
if($_POST["action"]=="login"){

  if($_POST["action"]=="login"){
	  $user= filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
	  $password= filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

	  if(!empty($user)){

		  $userRow = $db->fetch_item("SELECT id FROM login WHERE usuario = '" . $db->escape_string($user) . "' AND estado = 1");
		  if($userRow){
			  $passRow = $db->fetch_item("SELECT usuario,contrasenia,nombre FROM login WHERE usuario = '" . $db->escape_string($user) . "' AND contrasenia = '" . $db->escape_string(md5($password)) . "' AND estado = 1");
			  if($passRow){
				  $user = $passRow["usuario"];
				  $name = $passRow["nombre"];
				  $password = $passRow["contrasenia"];
				  if($password==md5("default")) $first = 1;
				  else $first = 0;
				  $_SESSION["panel"] = array("username" => $user, "name" => $name, "first" => $first);
				  $return = $_SESSION["return"];
				  if($return!=""){
					  header("Location: ".$return);
				  }
				  else{
				  	  header("Location: index.php");
				  }
			  }
			  else{
			  	$config["alerta"]["trow"][] = array(
					"msj" => 'Los datos ingresados no son válidos o la cuenta no está disponible.',
					"type" => "error",
					"close" => "show"
				); //Usuario OK, contraseña mal
			  }
		  }
		  else{
		  	$config["alerta"]["trow"][] = array(
				"msj" => 'Los datos ingresados no son válidos o la cuenta no está disponible.',
				"type" => "error",
				"close" => "show"
			); //El usuario no existe o bloqueado
		  }
	  }
	  else{
	  	$config["alerta"]["trow"][] = array(
			"msj" => 'Los datos ingresados no son válidos o la cuenta no está disponible.',
			"type" => "error",
			"close" => "show"
		); //Cantidad invalida de caracteres en el nombre de usuario
	  }
  }
  else{
  	$config["alerta"]["trow"][] = array(
		"msj" => 'Los datos ingresados no son válidos o la cuenta no está disponible.',
		"type" => "error",
		"close" => "show"
	); //No se han completado los campos requeridos
  }
}

if($_POST["action"]=="forgot"){

	$email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$emailRow = $db->fetch_item("SELECT * FROM login WHERE email = '" . $db->escape_string($email) . "' ");
		if($emailRow){
			$usuario = $emailRow['usuario'];
			$nombre = $emailRow['nombre'];
			$email = $emailRow['email'];
			$id = $emailRow['id'];
			$clave = $prefijo = substr(md5(uniqid(rand())),0,20);
			$db->insert("INSERT INTO reset (code, userId) VALUES ('".$clave."', '".$id."')");
			$maildata =
			array(
			"subject" => "Recuperar contraseña",
			"teaser" => "Procedimiento para la recuperación de la contraseña de su panel de administración para ".data("company"),
			"content" => "Hola ".$nombre.',<br /> se solicitó cambiar la contraseña de tu cuenta mediante el formulario de contraseña olvidada de tu <a href="http://'.data("domain").'/admin">panel de administración de '.data("company").'</a>.<br />Para continuar con el procedimiento por favor hacé click en el siguiente enlace:<br /><br /><a href="http://'.data("domain").'/admin/login.php?action=reset&c='.$clave.'">http://'.data("domain").'/admin/login.php?action=reset&c='.$clave.'</a><br /><br />Si no solicitaste un cambio de contraseña por favor ignorá este mensaje.<br />Para más información contactá vía email a '.data("webmaster-email")
			);
			$ruta = 'http://'.$dominio.'/includes/mailer/template.php';
			$body = file_get_contents($ruta);
			$body = str_replace('{SUBJECT}', $maildata["subject"], $body);
			$body = str_replace('{TEASER}', $maildata["teaser"], $body);
			$body = str_replace('{MAINCONTENT}', $maildata["content"], $body);
			$mail = new PHPMailer();
			$mail->CharSet = 'UTF-8';
			$mail->From = data("email");
			$mail->FromName = data("company");
			$mail->Subject = $maildata["subject"];
			$mail->AltBody = strip_tags(str_replace("<br />","\n",$maildata["content"]),"<br>");
			$mail->Body = $body;
			$mail->IsHTML(true);
			$mail->AddAddress($email, $nombre);
			if($mail->Send()){
				$config["alerta"]["trow"][] = array(
					"msj" => 'Por favor revise su bandeja de entrada de correo electrónico. En caso de haber recibido un correo para recuperar su contraseña siga los pasos allí indicados, de lo contrario por favor contacte con su porveedor de servicios web.',
					"type" => "info",
					"close" => "show"
				);
			}
			else{
				$config["alerta"]["trow"][] = array(
					"msj" => '<p>No se ha podido completar el proceso de recuperación de contraseña.</p>',
					"type" => "error",
					"close" => "show"
				); //No se pudo mandar el mail
			}
		}
		else{
			$config["alerta"]["trow"][] = array(
				"msj" => '
					<h4 class="alert-heading">Por favor revise su bandeja de entrada de correo electrónico.</h4>
					<p>En caso de haber recibido un correo para recuperar su contraseña siga los pasos allí indicados, de lo contrario por favor contacte con su proveedor de servicios web.</p>',
				"type" => "info",
				"close" => "show"
			); //El email no existe
		}
	}
	else{
		$config["alerta"]["trow"][] = array(
			"msj" => '<p>No se ha podido completar el proceso de recuperación de contraseña. Por favor <b>complete todos los campos solicitados</b></p>',
			"type" => "error",
			"close" => "show"
		); //No se han completado los campos requeridos
	}
}

if($_POST["action"]=="reset"){

	$code = $_POST["code"];
	$newResetQueryRow = $db->fetch_item("SELECT userId FROM reset WHERE code='$code' AND estado=0");
	if($newResetQueryRow){
		$userId = $newResetQueryRow['userId'];
		$updateStatusQuery = $db->update("UPDATE reset SET estado=1 WHERE code='$code'");
		$pass = $_POST["pass"];
		if($db->update("UPDATE login SET contrasenia='".md5($pass)."' WHERE id='$userId'")){
			$config["alerta"]["trow"][] = array(
				"msj" => "La contraseña ha sido modificada con éxito.",
				"type" => "exito",
				"close" => "show"
			);
		}
		else{
			$config["alerta"]["trow"][] = array(
				"msj" => "No se ha podido procesar su solicitud. Por favor reintente el proceso de recuperación.",
				"type" => "error",
				"close" => "show"
			); //Probablemente el usuario no existe, el código no existe o ya fue usado
		}
	}
	else{
		$config["alerta"]["trow"][] = array(
			"msj" => "No se ha podido procesar su solicitud.",
			"type" => "error",
			"close" => "show"
		); //No existe el codigo de validacion
	}
}
//Gestión de alertas
switch ($_GET["action"]){
	case "login":
		$config["alerta"]["trow"][] = array(
			"msj" => "Necesita iniciar sesión para acceder a esta página.",
			"type" => "aviso",
			"close" => "show"
		);
	break;
	case "logout":
		session_unset();
		session_destroy();
		$config["alerta"]["trow"][] = array(
			"msj" => "La sesión fue cerrada con éxito.",
			"type" => "exito",
			"close" => "show"
		);
	break;
	case "forgot":
		session_unset();
		session_destroy();
		$config["alerta"]["trow"][] = array(
			"msj" => "Escriba su dirección de correo electrónico para recibir instrucciones sobre la recuperación de su contraseña.",
			"type" => "info",
			"close" => "hide"
		);
	break;
}
if($_GET["action"]=="reset"&&$_GET["c"]){
	$config["alerta"]["trow"][] = array(
		"msj" => "Ingrese la contraseña que desea utilizar para su cuenta.",
		"type" => "info",
		"close" => "hide"
	);
}
if($_GET["action"]=="reset"&&!$_GET["c"]){
	$config["alerta"]["trow"][] = array(
		"msj" => "Su solicitud no puede ser procesada.<br>".$config["help"]["text"],
		"type" => "error",
		"close" => "show"
	);
}
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
    <meta charset="<?=$charset?>">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo data("company"); ?> - Panel de Administración</title>
    <link rel="stylesheet" href="css/style.min.css" />
    <link rel="stylesheet" href="css/custom.min.css" />
    <script src="../js/modernizr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div class="pattern"></div>
	<div class="container">
	<?php if($_SESSION["panel"]) { include("includes/layout/header.php"); } ?>
	<section class="well">
	  <?php if($_SESSION["panel"]) { include("includes/layout/menu.php"); } ?>
	  <?php include("includes/functions/alertas.php");
	  if(!$_GET["action"]||$_GET["action"]=="login"||$_GET["action"]=="logout"||$error){
	  ?>
	  <form class="form-horizontal" id="iniciar-sesion" name="iniciar-sesion" method="post" action="login.php">
	      <fieldset>
	          <legend>Iniciar sesión</legend>
	          <div class="control-group">
	              <label class="control-label" for="user">Usuario</label>
	              <div class="controls">
	                <input class="required" type="text" name="user" />
	              </div>
	          </div>
	          <div class="control-group">
	              <label class="control-label" for="pass">Contraseña</label>
	              <div class="controls">
	                <input autocomplete="off" class="required" type="password" name="pass" />
	              </div>
	          </div>
	          <div class="form-actions">
	            	<input type="hidden" value="login" name="action" />
	                <button class="btn btn-info" type="submit" name="login">Iniciar sesión</button>
	          </div>
	      </fieldset>
	  </form>
		<p><a href="?action=forgot">¿Olvidaste tu contraseña?</a></p>
		<? }
		if($_GET["action"]=="reset"&&$_GET["c"]!=""){
		?>
		<form class="form-horizontal" id="reset-form" name="reset-form" method="post" action="login.php">
	      <fieldset>
	          <legend>Reestablecer contraseña</legend>
	          <div class="control-group">
	              <label class="control-label" for="pass">Nueva contraseña</label>
	              <div class="controls">
	                <input class="required" type="text" name="pass" />
	              </div>
	          </div>
	          <div class="form-actions">
	            	<input type="hidden" value="reset" name="action" />
					<input type="hidden" value="<? echo $_GET["c"]; ?>" name="code" />
	                <button class="btn btn-info" type="submit" name="reset">Cambiar contraseña</button>
	                <a class="btn" href="login.php">Cancelar</a>
	          </div>
	      </fieldset>
	    </form>
		<? }
		if($_GET["action"]=="forgot"){ ?>
		<form class="form-horizontal" id="forgot-form" name="forgot-form" method="post" action="login.php">
	      <fieldset>
	          <legend>Reestablecer contraseña</legend>
	          <div class="control-group">
	              <label class="control-label" for="email">Correo electrónico</label>
	              <div class="controls">
	                <input class="required email" type="text" name="email" />
	              </div>
	          </div>
	          <div class="form-actions">
	            	<input type="hidden" value="forgot" name="action" />
	                <button class="btn btn-info" type="submit" name="forgot">Solicitar contraseña</button>
	                <a class="btn" href="login.php">Cancelar</a>
	          </div>
	      </fieldset>
	    </form>
		<?
		}
		?>
	</section>
	<? include("includes/layout/footer.php") ?>
	</div>
	<script src="../js/jquery.validate.min.js"></script>
	<script>
	$(document).ready(function(){
		$(".form-horizontal").validate({
			errorClass: "help-inline",
			validClass: "help-inline",
			errorElement: "span",
			highlight: function(element) {
				$(element).parent().parent().addClass("error");
			},
			unhighlight: function(element) {
				$(element).parent().parent().removeClass("error");
			}
		});
		$(".alert").alert();
		$('.dropdown-toggle').dropdown();
	});
	</script>
</body>
</html>
