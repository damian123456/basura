<?php
	/* NOSOTROS */
	/* CURSOS */
	/* COPIA DE courses.PHP, REMPLACE:  categoria | curso , categorias | courses , nombre | title , link | excerpt */
?>

<?
	include('inc/init.php');
	require_once("../includes/config.php");//agregue
	$action = $_GET['action'];

	switch($_GET['msg_code']){
		case 1:
			$mensajes[] = 'El curso fue <strong>añadido</strong> con éxito';
		break;
		case 2:
			$mensajes[] = 'El curso fue <strong>actualizado</strong> con éxito';
		break;
		case 3:
			$mensajes[] = 'El curso fue <strong>eliminada</strong> con éxito';
		break;
	}

	switch($action){
		case 'add':
			$title = $db->escape_string($_POST['title']);
			$parent = (int) $_POST['parent'];
		/* remplace nomostrar por */
			$noMostrar = (int) $_POST['noMostrarEnMenu'];
		/* remplace link por excerpt*/
			$excerpt = $_POST['excerpt'];
			if($title){
				$db->insert("INSERT INTO courses SET title = '{$title}', parent = {$parent}, noMostrarEnMenu = {$noMostrar}, excerpt = '$excerpt'");

				if(!$db->error())
					redirect("courses.php?msg_code=1");
				else
					$errores[] = $db->error();
			}
			break;

		case 'edit':
			$id = (int) $_GET['id'];
			$title = $db->escape_string($_POST['title']);
			$parent = (int) $_POST['parent'];
			$noMostrar = ($_POST['noMostrarEnMenu']?1:0);
			$excerpt = $_POST['excerpt'];
			if($title&&$id>0){
				$db->update("UPDATE courses SET title = '{$title}', parent = {$parent}, noMostrarEnMenu = {$noMostrar}, excerpt = '$excerpt' WHERE id = {$id}");

				if(!$db->error())
					redirect("courses.php?msg_code=2");
				else
					$errores[] = $db->error();
			}
			break;

		case 'delete':
			$id = (int) $_GET['id'];
			if($id>0){
				$db->delete("DELETE FROM courses WHERE id = {$id}");
				if(!$db->error())
					redirect("courses.php?msg_code=3");
				else
					$errores[] = $db->error();
			}
			break;
	}

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
	<script src="js/jquery.sieve.min.js"></script>
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
</head>

<body>
	<div class="container">
		<?php include("includes/layout/header.php"); ?>
		<div class="well box">
			<?php include("includes/layout/menu.php"); ?>
			<? include("includes/functions/alertas.php"); ?>
			<div class="contenido row">
				<div class="col-sm-12">

<?	if(is_array($errores)){ ?><div class="alert alert-error"><ul><li><?=implode('</li><li>',$errores)?></li></ul></div><?	} ?>
<?	if(is_array($mensajes)){ ?><div class="alert alert-success"><ul><li><?=implode('</li><li>',$mensajes)?></li></ul></div><?	} ?>

<?
		switch($action){

			case 'edit': // Si estamos agregando un nuevo banner mostramos el formulario
				$id_curso = (int) $_GET['id'];
				$curso = $db->fetch_item("SELECT * FROM courses WHERE id = {$id_curso}");

			case 'new': // Si estamos agregando un nuevo banner mostramos el formulario
				if($curso){
					$courses = $db->fetch_all("SELECT * FROM courses WHERE id!={$curso['id']} ORDER BY parent,id");
				} else {
					$courses = $db->fetch_all("SELECT * FROM courses ORDER BY parent,orden,title");
				}
				$courses = build_tree($courses);
				include 'templates/courses_add.php';
				break;

			default:
				// Traemos los banners
				$courses = $db->fetch_all("
					SELECT title FROM courses ORDER BY parent, id  ASC
				");
				$courses = build_tree($courses);
				include 'templates/courses_list.php';
		}
?>
				</div>
			</div>
		</div>
		<?php include("includes/layout/footer.php"); ?>
	</div>
	<? if(!$_POST["action"]=="password"&&$_SESSION["panel"]["first"]==1||!$_POST["action"]=="password"&&$_GET["action"]=="password"){ ?>
	<div class="modal hide" id="firstTime">
	<form action="index.php" method="POST">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3>Nueva contraseña</h3>
	</div>
		<div class="modal-body">
			<? if($_SESSION["panel"]["first"]==1){ ?><p>Antes de comenzar a gestionar el contenido de tu web es necesario que selecciones una contraseña para tu cuenta. Esto hará que tu panel de administración sea más seguro.</p><? } else{ ?><p>Completá el siguiente formulario para cambiar tu contraseña</p><? } ?>
				<label>Escribí una contraseña:</label>
				<input autocomplete="off" type="password" name="password" id="password">
				<label>Repetí la contraseña:</label>
				<input autocomplete="off" type="password" name="passwordagain">
			</div>
			<div class="modal-footer">
			<input type="hidden" name="action" value="password">
			<button type="submit" class="btn btn-info">Guardar cambios</button>
			<a href="#" class="btn" data-dismiss="modal">Seleccionar más tarde</a>
		</div>
	</form>
	</div>
	<? } ?>
	<script>
	function setCoords(c){
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	}

	function checkCoords(){
		if (parseInt($('#w').val())) return true;
		alert('Por favor, seleccione un área en la imagen para recortar antes de presionar el boton "cortar".');
		return false;
	};

	$(document).ready(function(){
		$(".alert").alert();
		$('.dropdown-toggle').dropdown();

		jQuery(function($) {
			var size = new Array("<?=$targ_w?>", "<?=$targ_h?>");

			$('#imagen_banner').Jcrop({
				onChange: setCoords,
				onSelect: setCoords,
				bgColor: 'black',
				minSize: size,
				bgOpacity:   .4,
				setSelect:   [ 100, 100, 50, 50 ],
				aspectRatio: 16 / 9
			});
		});

	});
	</script>
</body>
</html>

<?
	/*FIN COPIA DE SECCIONES.PHP, REMPLACE: seccion | curso , secciones | cursos (desp) cursos | courses , nombre | title */
	/* FIN CURSOS */
	/* FIN NOSOTROS */
?>
