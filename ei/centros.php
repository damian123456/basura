<?
    require_once("includes/config.php");//agregue 
        
?>
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
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?=url('css/ie.min.css')?>">
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Educa Idiomas</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style2.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>

        <link rel="apple-touch-icon" href="images/favicon.png"/>
        <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/respond.min.js"></script>
          <script src="js/html5.js"></script>
        <![endif]-->

        <!--[if gte IE 9]>
          <style type="text/css">
            .gradient {
               filter: none;
            }
          </style>
        <![endif]-->

    </head>
    <body>

        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-libreria-1.png" alt="" class="firulete-libreria-1">
            <img src="img/firulete-libreria-2.png" alt="" class="firulete-libreria-2">
            <img src="img/firulete-libreria-3.png" alt="" class="firulete-libreria-3">
            <img src="img/firulete-libreria-4.png" alt="" class="firulete-libreria-4">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
			<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <br><br><a href="contacto.php" class="btn btn-franquicias in-tablas">SU CONSULTA NOS INTERESA</a>
                </div>	
			</div>
            	
		</div>
          
        
        <?php include("inc-footer.php"); ?>
    </body>
</html>
