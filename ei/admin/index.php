<?
	include('inc/init.php');
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
    <meta charset="<?=$charset?>">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$nombre_sitio?> - Panel de Administración</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="js/jquery.Jcrop.min.js"></script>
    <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
		<script src="js/jquery.sieve.min.js"></script>
</head>

<body>
    <div class="container">
    	<?php include("includes/layout/header.php"); ?>
            <section class="well">
            <?php include("includes/layout/menu.php"); ?>
            <? include("includes/functions/alertas.php"); ?>
            <div class="alert alert-block alert-info fade in" data-alert="alert"><h4 class="alert-heading">¡Hola <?=$_SESSION['panel']['name']?>!</h4>
			<p>Bienvenido a tu panel de administración. Hacé click en alguna de las opciones para gestionar tu contenido.</p>
			<p><a href="courses.php" class="btn btn-info">Listado de contenidos</a> <a href="courses.php?action=new" class="btn">Subir nuevo contenido</a></p></div>
            </section>
        <?php include("includes/layout/footer.php"); ?>
    </div>
    <? if(!$_POST["action"]=="password"&&$_SESSION["panel"]["first"]==1||!$_POST["action"]=="password"&&$_GET["action"]=="password"){ ?>
    <div class="modal fade" id="firstTime">
			<form action="index.php" method="POST" class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">×</button>
							<h3>Nueva contraseña</h3>
					</div>
					<div class="modal-body">
						<? if($_SESSION["panel"]["first"]==1){ ?><p>Antes de comenzar a gestionar el contenido de tu web es necesario que selecciones una contraseña para tu cuenta. Esto hará que tu panel de administración sea más seguro.</p><? } else{ ?><p>Completá el siguiente formulario para cambiar tu contraseña</p><? } ?>
						<label>Escribí una contraseña:</label>
						<input autocomplete="off" type="password" name="password" id="password">
						<br>
						<label>Repetí la contraseña:</label>
						<input autocomplete="off" type="password" name="passwordagain">
					</div>
					<div class="modal-footer">
						<input type="hidden" name="action" value="password">
						<button type="submit" class="btn btn-info">Guardar cambios</button>
						<a href="#" class="btn" data-dismiss="modal">Seleccionar más tarde</a>
					</div>
				</div>
			</form>
    </div>
    <? } ?>
    <script src="js/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function(){
        $(".alert").alert();
        $('.dropdown-toggle').dropdown();
        <? if(!$_POST["action"]=="password"&&$_SESSION["panel"]["first"]==1||!$_POST["action"]=="password"&&$_GET["action"]=="password"){ ?>
        $('#firstTime').modal('show');
        $("#firstTime form").validate({
            rules: {
              password: "required",
              passwordagain: {
                equalTo: "#password"
              }
            },
            errorClass: "help-inline",
            validClass: "help-inline",
            errorElement: "span"
        });
        <? } ?>
    });
    </script>
</body>
</html>
