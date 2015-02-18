<?
	include('inc/init.php');
require_once("../includes/config.php");//agregue
	$action = $_GET['action'];
	$id = (int) $_GET['id'];
	$targ_w = $targ_h = 100;
	$upload_dir = '../uploads/';

	switch($_GET['msg_code']){
		case 1:
			$mensajes[] = 'El representante fue <strong>añadido</strong> con éxito';
		break;
		case 2:
			$mensajes[] = 'El representante fue <strong>editado</strong> con éxito';
		break;
		case 3:
			$mensajes[] = 'El representante fue <strong>eliminado</strong> con éxito';
		break;
	}

	switch($action){
		case 'add':
			$id = $db->escape_string($_POST['id']);
			if($id){
				$item = $db->fetch_item("SELECT * FROM representantes WHERE id = {$id}");
			}
			$nombre = $db->escape_string($_POST['nombre']);
			$id_pais = (int)$_POST['id_pais'];
			$provincia = $db->escape_string($_POST['provincia']);
			$ciudad = $db->escape_string($_POST['ciudad']);
			$direccion = $db->escape_string($_POST['direccion']);
			$telefono = $db->escape_string($_POST['telefono']);
			$email = $db->escape_string($_POST['email']);
			$coordenadas = $db->escape_string($_POST['coordenadas_gmap']);
			$activo = ($_POST['activo']?1:0);

			if(isset($_POST['agregar_representante'])){

				if(!$nombre)
			$errores[] = 'Debe ingresar un nombre de representante';

				/*if(!$provincia)
			$errores[] = 'Debe ingresar la provincia';*/

				if(!$ciudad)
			$errores[] = 'Debe ingresar la ciudad';

				if(!$direccion)
			$errores[] = 'Debe ingresar una dirección válida';

				if(!$errores){
					$fields = "
			nombre = '{$nombre}',
			id_pais = '{$id_pais}',
			provincia = '{$provincia}',
			ciudad = '{$ciudad}',
			direccion = '{$direccion}',
			telefono = '{$telefono}',
			email = '{$email}',
			coordenadas = '{$coordenadas}',
			activo = '{$activo}'
					";

					if(!$item)
			$insert = $db->insert("INSERT INTO representantes SET {$fields}");
			else
			$update = $db->insert("UPDATE representantes SET {$fields} WHERE id = {$id}");

					if($insert)
			redirect('representantes.php?msg_code=1');

					if($update)
			redirect('representantes.php?msg_code=2');
				}
			}
		break;

		case 'active':
			$id = (int) $_GET['id'];

			if($id>0){
				$getState = $db->fetch_item_field("SELECT activo FROM representantes WHERE id = {$id}");
				$estado = ($getState?0:1);

				$db->delete("UPDATE representantes SET activo = '{$estado}' WHERE id = {$id}");

				if(!$db->error())
					redirect("representantes.php?msg_code=2");
				else
					$errores[] = $db->error();
			}
		break;

		case 'delete':
			$id = (int) $_GET['id'];

			if($id>0){
				$db->delete("DELETE FROM representantes WHERE id = {$id}");

				if(!$db->error())
					redirect("representantes.php?msg_code=3");
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
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/custom.min.css" />
	<link rel="stylesheet" href="css/estilos.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script type="text/javascript">
	$(document).bind("mobileinit", function(){
		$.extend(  $.mobile , {
		ajaxEnabled: false,
		defaultPageTransition: 'none'
		});
	});
	</script>
<?	if(!isset($_GET['action'])){	?>
	<script src="http://code.jquery.com/mobile/1.4.0-alpha.2/jquery.mobile-1.4.0-alpha.2.min.js"></script>
	<script src="js/jquery.ui.touch-punch.min.js"></script>
<?	}	?>
	<script src="js/jquery.sieve.min.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
</head>

<body onload="initialize()">
	<div class="container">
		<?php include("includes/layout/header.php"); ?>
		 <div class="well box">
			<?php include("includes/layout/menu.php"); ?>
			<? include("includes/functions/alertas.php"); ?>
			<div class="contenido row">
				<div class="col-sm-12">

<?		  if($errores){
					print '<div class="alert alert-error">';
					print '<ul>';
					foreach($errores as $k => $e){
						print '<li>'.$e.'</li>';
					}
					print '</ul>';
					print '</div>';
				}
?>
<?		  if($mensajes){
					print '<div class="alert alert-success">';
					print '<ul>';
					foreach($mensajes as $k => $e){
						print '<li>'.$e.'</li>';
					}
					print '</ul>';
					print '</div>';
				}


			$pais = $db->fetch_all("SELECT * FROM Country");

			switch($action){
				case 'new': // Si estamos agregando un nuevo banner mostramos el formulario
					include 'templates/representantes_add.php';
					break;

				case 'edit': // Si estamos editando un representante
					$representante = $db->fetch_item("
					SELECT r.*, c.id AS id_pais FROM representantes AS r
						LEFT JOIN country AS c
						ON c.id = r.id_pais
					WHERE r.id = {$id}
					");
					include 'templates/representantes_edit.php';
					break;

				default:
					$representantes = $db->fetch_all("
					SELECT r.*, p.Name AS pais FROM representantes AS r
						LEFT JOIN Country AS p
						ON p.id = r.id_pais
					");
					include 'templates/representantes_list.php';
?>
<?	  }   ?>
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

	/* GOOGLE MAPS */
	var geocoder;
	var markers = [];
	var map;
	var timer;
	var initialAdress = '<?=($representante['coordenadas']?$representante['coordenadas']:$representante['direccion'].', '.$representante['ciudad'].', '.$representante['provincia'].', '.$representante['pais'])?>';

	function initialize() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(<?=($representante['coordenadas']?$representante['coordenadas']:'-38.00258810746939,-57.549303621053696')?>);
		var mapOptions = {
			zoom: 12,
			center: latlng
		}
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

		<?if($representante){?>
		codeAddress(initialAdress);
		<?}?>

		google.maps.event.addListener(map, "click", function(event) {
			deleteMarkers();
			var lat = event.latLng.lat();
			var lng = event.latLng.lng();
			addMarker(event.latLng);
		});
	}

	// Add a marker to the map and push to the array.
	function addMarker(location) {
		var marker = new google.maps.Marker({
		position: location,
		map: map
		});
		markers.push(marker);
	}

	// Sets the map on all markers in the array.
	function setAllMap(map) {
		for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
		}
	}

	// Removes the markers from the map, but keeps them in the array.
	function clearMarkers() {
		setAllMap(null);
	}

	// Shows any markers currently in the array.
	function showMarkers() {
		setAllMap(map);
	}

	// Deletes all markers in the array by removing references to them.
	function deleteMarkers() {
		clearMarkers();
		markers = [];
	}

	function codeAddress(address) {
		deleteMarkers();
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				addMarker(results[0].geometry.location);
				var lat = results[0].geometry.location.lat();
				var lng = results[0].geometry.location.lng();
				console.log(lat,lng);
				$('#coordenadas_gmap').val(lat+','+lng);
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}

	function actualizarMapa(){
		clearTimeout(timer);

		var pais = $('#pais').find(':selected').data('name');
		var provincia = $('#provincia').val();
		var ciudad = $('#ciudad').val();
		var direccion = $('#direccion').val();
		var address = direccion+', '+ciudad+', '+provincia+', '+pais;

		timer = setTimeout(function(){codeAddress(address);},3000);
	}
	/* END */


	function renderImage(ev){
		var file = this.files[0];
		var canvas = $('canvas')[0];
		var img = document.createElement("img");

		if(file.type.match('video/mp4')){
			return;
		}
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
		$(".alert").alert();
		$('.dropdown-toggle').dropdown();

		$('#archivo').change(renderImage);

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
	});
	</script>
</body>
</html>
