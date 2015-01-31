<?
	include('inc/init.php');
require_once("../includes/config.php");//agregue
	$action = $_GET['action'];
	$upload_dir = '../uploads/';
	$targ_w = 195;
	$targ_h = 98;
	$img_quality = 95;

	switch($_GET['msg_code']){
		case 1:
			$mensajes[] = 'El cliente fue <strong>actualizado</strong> con éxito';
		break;
		case 2:
			$mensajes[] = 'El cliente fue <strong>añadido</strong> con éxito';
		break;
		case 3:
			$mensajes[] = 'El cliente fue <strong>eliminado</strong> con éxito';
		break;
	}

	switch($action){
		case 'upload':
			if(isset($_POST['subir_cliente'])){
				$id = $db->escape_string($_POST['id']);

				if($id){
					$item = $db->fetch_item("SELECT * FROM clientes WHERE id = {$id}");
				}

				$nombre = $db->escape_string($_POST['nombre']);
				$url = $db->escape_string($_POST['url']);
				$activo = ($_POST['activo']?1:0);
				$crop_data = json_decode($_POST['coords'],true);
				$archivo = $_FILES["archivo"];

				if(!$nombre && isset($_POST['subir_cliente'])){
					$errores[] = 'Debe escribir un nombre';
				}

				/*if(!$url){
					$errores[] = 'Debe escribir una dirección URL';
				}*/

				if(!$archivo['tmp_name'] && !$item){
					$errores[] = 'Error al recibir el archivo';
				} elseif($archivo['tmp_name']) {
					$allowedExts = array("jpeg", "jpg", "png");
					$allowedMime = array("image/jpeg","image/jpg","image/pjpeg","image/x-png","image/png");
					$extension = end(explode(".", $archivo['name']));
					$max_size = 5242880;

					list($width_tmp, $height_tmp) = getimagesize($archivo['tmp_name']);

					if($archivo['size'] > $max_size){
						$errores[] = "El archivo es demasiado grande. El tama&ntilde;o m&aacute;ximo es de 5Mb.";
					}
					if($width_tmp < $targ_w || $height_tmp < $targ_h){
						$errores[] = "La imagen en muy pequeña. Debe medir al menos {$targ_w}x{$targ_h}";
					}

					if (!in_array($archivo["type"], $allowedMime) || !in_array(strtolower($extension), $allowedExts)){
						$errores[] = "Archivo invalido";
					}
				}

				if(empty($errores)){
					if($archivo){
						$image = new Image($archivo["tmp_name"],$error);
						if($error){
							$errores[] = $error;
						} else {
							$filename = getUniqueFilename(basename($archivo['name'],".{$extension}"),".".strtolower($extension),$upload_dir);

							$image->crop($crop_data['x'],$crop_data['y'],$crop_data['w'],$crop_data['h']);
							$image->resize($targ_w, $targ_h, MODE_FIXED);
							$image->save($upload_dir.$filename);
						}
					}

					$fields = "
						nombre = '{$nombre}',
						url = '{$url}',
						activo = '$activo'
					";

					if($filename){
						$fields.=",archivo = '{$filename}'";
					}
					if($item){
						if($filename){
							@unlink($upload_dir.$item['archivo']);
						}
						$sql = "UPDATE clientes SET {$fields} WHERE id = {$id}";
						$db->update("UPDATE clientes SET {$fields} WHERE id = {$id}");
					} else {
						$sql = "INSERT INTO clientes SET {$fields}";
						$insert = $db->insert("INSERT INTO clientes SET {$fields}");
					}
					if($_POST['apply']){
						redirect("clientes.php?id={$id}");
					} else {
						redirect("clientes.php?list=".$_POST['list']);
					}
				}

			}
			break;

		case 'delete':
			$id_cliente = (int) $_GET['id_cliente'];
			if($id_cliente>0){
				$db->delete("DELETE FROM clientes WHERE id = {$id_cliente}");

				if(!$db->error())
					redirect('clientes.php?msg_code=3');
				else
					$errores[] = $db->error();
			}
			break;

		case 'state':
			$id_cliente = (int) $_GET['id_cliente'];
			if($id_cliente>0){
				$check_state = $db->fetch_item_field("SELECT activo FROM clientes WHERE id = {$id_cliente}");

				if($check_state)
					$db->update("UPDATE clientes SET activo = 0 WHERE id = {$id_cliente}");
				else
					$db->update("UPDATE clientes SET activo = 1 WHERE id = {$id_cliente}");

				if(!$db->error())
					redirect('clientes.php?msg_code=1');
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
	<script src="../js/mediaelementjs/mediaelement-and-player.min.js"></script>
	<link rel="stylesheet" href="../js/mediaelementjs/mediaelementplayer.css" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).bind("mobileinit", function(){
			$.extend(  $.mobile , {
				ajaxEnabled: false,
				defaultPageTransition: 'none'
			});
		});
	</script>
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
				case 'new': // Si estamos agregando un nuevo cliente mostramos el formulario
					include 'templates/clientes_add.php';
				break;

				case 'edit': // Si estamos editando un cliente mostramos el formulario
					$cliente = $db->fetch_item("SELECT * FROM clientes WHERE id =".intval($_GET['id_cliente']));
					include 'templates/clientes_edit.php';
				break;

				case 'upload':
					if(!$errores)
						if($subido)
							print '<div class="alert alert-success">El cliente fue subido con éxito.</div>';
				break;

				default:
					include 'templates/clientes_list.php';

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

		function renderImage(ev){
			var file = this.files[0];
			var canvas = $('canvas')[0];
			var img = document.createElement("img");

			var reader = new FileReader();

			reader.onload = (function(img,canvas){
				return function(e) {
					img.src = e.target.result

					var width = img.width;
					var height = img.height;

					if(width < <?=$targ_w?> || height < <?=$targ_h?>){
						alert("La imagen debe medir al menos <?=$targ_w?>x<?=$targ_h?>px");
						return;
					}

					canvas.width = width;
					canvas.height = height;
					var ctx = canvas.getContext("2d");
					ctx.drawImage(img, 0, 0, width, height);

					canvas.style.maxWidth = '100%';
					canvas.style.height = 'auto';
					$('.image_view').hide();

					$(canvas).Jcrop({
						onChange: setCoords,
						trueSize: [ width, height ],
						aspectRatio: (<?=$targ_w?> / <?=$targ_h?>),
						minSize: [<?=$targ_w?>, <?=$targ_h?>],
						bgOpacity: .4,
						setSelect: [ 0, 0, <?=$targ_w?>, <?=$targ_h?> ]
					});
				}
			})(img,canvas);

			reader.readAsDataURL(file);
		}

		function setCoords(c){
			var a = {
				x: Math.ceil(c.x),
				y: Math.ceil(c.y),
				w: Math.round(c.w),
				h: Math.round(c.h)
			};
			$('#coords').val(JSON.stringify(a));
		}

		function checkCoords(){
			if ($('#coords').val().length > 0) return true;
			alert('Por favor, seleccione un área en la imagen para recortar antes de presionar el boton "Guardar".');
			return false;
		};

		$(document).ready(function(){
			$('#archivo').change(renderImage);
		});

		function cambiar_filtro(value){
			location.href = 'clientes.php?list='+value;
		}

		$("#sortable").sortable({
			update: function(event, ui) {
				var orden = $(this).sortable('toArray').toString();
				$.get('order.php', {orden:orden, order_general:'1'});
			}
		}).disableSelection();
	</script>
</body>
</html>
