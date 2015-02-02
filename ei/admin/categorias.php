<?
	include('inc/init.php');
require_once("../includes/config.php");//agregue
	$action = $_GET['action'];

	switch($_GET['msg_code']){
		case 1:
			$mensajes[] = 'La categoría fue <strong>añadida</strong> con éxito';
		break;
		case 2:
			$mensajes[] = 'La categoría fue <strong>actualizada</strong> con éxito';
		break;
		case 3:
			$mensajes[] = 'La categoría fue <strong>eliminada</strong> con éxito';
		break;
	}

	switch($action){
		case 'add':
			$nombre = $db->escape_string($_POST['nombre']);
			$parent = (int) $_POST['parent'];
			$noMostrar = (int) $_POST['noMostrarEnMenu'];
			$link = $_POST['link'];
			if($nombre){
				$db->insert("INSERT INTO categorias SET nombre = '{$nombre}', parent = {$parent}, noMostrarEnMenu = {$noMostrar}, link = '$link'");

				if(!$db->error())
					redirect("categorias.php?msg_code=1");
				else
					$errores[] = $db->error();
			}
			break;

		case 'edit':
			$id = (int) $_GET['id'];
			$nombre = $db->escape_string($_POST['nombre']);
			$parent = (int) $_POST['parent'];
			$noMostrar = ($_POST['noMostrarEnMenu']?1:0);
			$link = $_POST['link'];
			if($nombre&&$id>0){
				$db->update("UPDATE categorias SET nombre = '{$nombre}', parent = {$parent}, noMostrarEnMenu = {$noMostrar}, link = '$link' WHERE id = {$id}");

				if(!$db->error())
					redirect("categorias.php?msg_code=2");
				else
					$errores[] = $db->error();
			}
			break;

		case 'delete':
			$id = (int) $_GET['id'];
			if($id>0){
				$db->delete("DELETE FROM categorias WHERE id = {$id}");
				if(!$db->error())
					redirect("categorias.php?msg_code=3");
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
				$id_categoria = (int) $_GET['id'];
				$categoria = $db->fetch_item("SELECT * FROM categorias WHERE id = {$id_categoria}");

			case 'new': // Si estamos agregando un nuevo banner mostramos el formulario
				if($categoria){
					$categorias = $db->fetch_all("SELECT * FROM categorias WHERE id!={$categoria['id']} ORDER BY parent,orden,nombre");
				} else {
					$categorias = $db->fetch_all("SELECT * FROM categorias ORDER BY parent,orden,nombre");
				}
				$categorias = build_tree($categorias);
				include 'templates/categorias_add.php';
				break;

			default:
				// Traemos los banners
				$categorias = $db->fetch_all("
					SELECT c.* FROM categorias AS c ORDER BY c.parent,c.orden,c.nombre ASC
				");
				$categorias = build_tree($categorias);
				include 'templates/categorias_list.php';
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
