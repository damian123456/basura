<?
	include("includes/config.php");
    
    //$galeria = $db->fetch_all("SELECT nombre FROM galerias where categoria=".$_GET['idc']." order by order, id asc ");
	
    
    $videos = $db->fetch_all("SELECT * FROM galerias_contenido AS c
                    JOIN galerias AS g
                        ON g.id = c.id_galeria
                WHERE url_youtube<>'' and (g.categoria=0 or g.categoria=2)
                ORDER BY g.orden");
    

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Instituto Educa Idiomas, cursos de ingles, aleman, ruso, chino, japones</title>
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
<style>
.container-galeria img {
     height: 145px;
 
}
</style>
    </head>
    <body>

        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-galeria-1.png" alt="" class="firulete-galeria-1">
            <img src="img/firulete-galeria-2.png" alt="" class="firulete-galeria-2">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h1 class="titulo-seccion in-libreria">Galería</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="nav nav-pills">
                    	<li><a href="galeria.php">Inicio</a></li>
                        <li><a href="#">Videos</a></li>
                        <li><a href="viajes.php">Viajes Culturales</a></li>
                        
                    </ul>
                </div>
            </div>    
                
            <div class="row">
            	<?php
            	$hay = false;
            	if(count($videos)>0) {
                        foreach($videos as $f){
                        	if ($f['url_youtube']<>'') {
                        		$cod = explode('=',$f['url_youtube']);
	                        	echo "<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
	                    			<a href='".$f['url_youtube']."' >
	                        		<div class='container-galeria container-video'>
	                            		<iframe width='560' height='315' src='//www.youtube.com/embed/".$cod[1]."' frameborder='0' allowfullscreen></iframe>
	                                </div>
	                    			</a>
	                    			</div>";
								$hay = true;	
							}
                     }
				}
				if (!$hay) {
					echo "<br><p>No se encontraron videos </p><br>";
					}
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <nav class="paginador">
                      <ul class="pagination">
                        
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
