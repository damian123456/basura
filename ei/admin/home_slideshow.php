<?
	include('inc/init.php');

	$action = $_REQUEST['action'];
	$id = intval($_REQUEST['id']);

	$upload_dir = '../uploads/';
	$targ_w = 940;
	$targ_h = 408;
	$img_quality = 96;

	switch($_SESSION['msg_code']){
		case 1:
			$mensajes[] = 'El banner fue <strong>actualizado</strong> con éxito';
		break;
		case 2:
			$mensajes[] = 'El banner fue <strong>añadido</strong> con éxito';
		break;
		case 3:
			$mensajes[] = 'El banner fue <strong>eliminado</strong> con éxito';
		break;
	}
	$_SESSION['msg_code'] = null;
	unset($_SESSION['msg_code']);

	if($id){
		$item = $db->fetch_item("SELECT * FROM home_slideshow WHERE id=$id");
	}

	if($_POST['save']){

		$title = $db->escape_string($_POST['title']);
		$subtitle = $db->escape_string($_POST['subtitle']);
		$details = $db->escape_string($_POST['details']);
		$green_btn_text = $db->escape_string($_POST['green_btn_text']);
		$green_btn_url = $db->escape_string($_POST['green_btn_url']);
		$red_btn_text = $db->escape_string($_POST['red_btn_text']);
		$red_btn_url = $db->escape_string($_POST['red_btn_url']);
		$active = ($_POST['active']?1:0);
		$crop_data = json_decode($_POST['coords'],true);
		$position = 0; //POSICION INICIAL / ORDEN INICIAL
		$archivo = $_FILES["archivo"];

		if(!$title || !$subtitle || !$green_btn_url)
			$errores[] = 'Todos los campos son obligatorios';

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
				title = '{$title}',
				subtitle = '{$subtitle}',
				details = '{$details}',
				green_btn_text = '{$green_btn_text}',
				green_btn_url = '{$green_btn_url}',
				red_btn_text = '{$red_btn_text}',
				red_btn_url = '{$red_btn_url}',
				position = '{$position}',
				active = '{$active}'
			";
			if($filename){
				$fields.=",image = '{$filename}'";
			}

			if($item){
				if($filename && $item['image'] && $filename!=$item['image']){
					@unlink($upload_dir.$item['image']);
				}
				$db->update("UPDATE home_slideshow SET {$fields},added=NOW() WHERE id = {$id}");
			} else {
				$insert = $db->insert("INSERT INTO home_slideshow SET {$fields},added=NOW()");
			}
			if($_POST['apply']){
				redirect("home_slideshow.php?id={$id}");
			} else {
				redirect("home_slideshow.php");
			}

		}
	}

	if($_GET['action'] == 'delete'){

		if($item){
			@unlink($upload_dir.$item['image']);
			$db->delete("DELETE FROM home_slideshow WHERE id={$item['id']}");

			if(!$db->error()){
				$_SESSION['msg_code'] = 3;
				redirect('home_slideshow.php');
			} else {
				$errores[] = $db->error();
			}
		}
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
		<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script src="js/jquery.Jcrop.min.js"></script>
		<script type="text/javascript">
			$(document).bind("mobileinit", function(){
				$.extend(  $.mobile , {
					ajaxEnabled: false,
					defaultPageTransition: 'none'
				});
			});
		</script>
		<script src="http://code.jquery.com/mobile/1.4.0-alpha.2/jquery.mobile-1.4.0-alpha.2.min.js"></script>
		<script src="js/jquery.ui.touch-punch.min.js"></script>
		<script src="js/jquery.sieve.min.js"></script>
</head>

<body>
	<div class="container">
		<? include("includes/layout/header.php"); ?>
		<div class="well box">
			<? include("includes/layout/menu.php"); ?>
			<? include("includes/functions/alertas.php"); ?>
			<div class="contenido row">
				<div class="col-sm-12">
				<? if($errores){ ?><div class="alert alert-error"><ul><li><?=implode('</li><li>',$errores)?></li></ul></div><? } ?>
				<? if($mensajes){ ?><div class="alert alert-success"><ul><li><?=implode('</li><li>',$mensajes)?></li></ul></div><? } ?>

<?
				if($item || $action=='new'){
					include 'templates/home_slideshow_add.php';
				} else {
					// Traemos los banners
					$items = $db->fetch_all("
						SELECT *
						FROM home_slideshow
						ORDER BY position, id
					");
					include 'templates/home_slideshow_list.php';
				}
?>

				</div>
			</div>
			<?php include("includes/layout/footer.php"); ?>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$(".alert").alert();
			$('.dropdown-toggle').dropdown();

			// Return a helper with preserved width of cells
	        var fixHelper = function(e, ui) {
	            ui.children().each(function() {
	                $(this).width($(this).width());
	            });
	            return ui;
	        };

	        $("#sort tbody").sortable({
	            helper: fixHelper,
	            update: function(event, ui) {
	                var orden = $(this).sortable('toArray').toString();
	                $.get('order.php', {orden:orden, order_general:'1'});
	            }
	        }).disableSelection();

	        var fixHelperModified = function(e, tr) {
	            var $originals = tr.children();
	            var $helper = tr.clone();
	            $helper.children().each(function(index)
	            {
	              $(this).width($originals.eq(index).width())
	            });
	            return $helper;
	        };
		});
	</script>
</body>
</html>
