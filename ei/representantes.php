<?
	include("includes/init.php");
	$representantes = $db->fetch_all("
	SELECT r.*, p.Name AS pais FROM representantes AS r
		JOIN Country AS p
		ON p.id = r.id_pais
		WHERE r.activo = 1
	");
?>
<!DOCTYPE html>
	<html class="no-js">
	<head>
		<meta charset="<?=$charset?>">
		<title>Institutos Representantes EDUCA-IDIOMAS ONLINE</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Hammersmith+One" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">
		<link rel="stylesheet" href="<?=url('css/style.min.css')?>">
		<script src="<?=url('js/vendor/modernizr.min.js')?>"></script>
		<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?=url('css/ie.min.css')?>">
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
	</head>
	<body class="contact">
		<?php include('includes/layout/header.php'); ?>
		<div id="main">
			<div class="locations">
				<div class="container">
					<div class="locations-title animate">
						<h2>Representantes</h2>
						<p>Consulte su representante más cercano</p>
					</div>
					<div class="locations-body">
						<div class="locations-content">
							<div class="thumb map-container animate">
								<div data-zoom="3" data-lat="-38.0152562" data-lng="-57.5714236" data-controls="false" class="map"></div>
							</div>
							<div class="locations-hq animate">
								<h3>Datos de la sede central</h3>
								<div class="locations-hq-info">
									<div class="wrap card-location" data-lat="-38.0152562" data-lng="-57.5714236">
										<h4>Instituto Educa Idiomas</h4>
										<p>Av. Juan José Paso 3420<br>
										Mar del Plata, Provincia de Buenos Aires, Argentina<br>
										Tel: (54) (0223) 4741380  / 4756012</p>
									</div>
								</div>
							</div>
						</div>
						<div class="sidebar animate">
<?		if($representantes){	?>
							<ul data-breakpoint="max-width: 850px">
<?
				foreach($representantes as $r){
					$coordenadas = explode(',',$r['coordenadas']);
?>
								<li>
									<div class="card">
										<h3 class="card-country">En <?=$r['pais']?></h3>
										<div data-lat="<?=$coordenadas[0]?>" data-lng="<?=$coordenadas[1]?>" class="card-location">
											<h4><?=$r['nombre']?></h4>
											<?=$r['direccion']?><br>
											<?=$r['ciudad']?> - <?=$r['provincia']?><br>
											Tel: <?=$r['telefono']?><br>
											Email: <a href="mailto:<?=$r['email']?>"><?=$r['email']?></a>
										</div>
									</div>
								</li>
<?			} ?>
							</ul>
<?		} ?>
						</div>
					</div>
				</div>
				<div class="contact">
					<div class="container animate">
						<div class="contact-title">
							<h3>Contáctese hoy con nosotros</h3>
						</div>
						<div class="contact-body">
							<?php include('includes/partials/contact-form.php'); ?>
							<img class="img thumb" src="<?=url('img/contact-contact.jpg')?>" alt="Consulta">
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('includes/layout/footer.php'); ?>
		<script src="<?=url('js/locations.min.js')?>"></script>
	</body>
</html>
