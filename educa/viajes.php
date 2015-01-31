<?php

include("includes/config.php");

    $tmp = $db->fetch_all("SELECT * FROM galerias WHERE categoria=2 ORDER BY orden, id desc");
	$num_total_registros = count($tmp);
    if(is_array($tmp)) {
        $galerias = $tmp;
        foreach($galerias as $key => $g){
            $tmp = $db->fetch_item("
                SELECT archivo, url_youtube FROM galerias_contenido AS c
                    JOIN galerias AS g
                        ON g.id = c.id_galeria
                WHERE c.id_galeria=".$g['id']." and archivo<>''
                ORDER BY archivo, titulo
            ");
           if(is_array($tmp)) {
            	$galerias[$key]['archivo'] = $tmp['archivo'];
			   	$galerias[$key]['url_youtube'] = $tmp['url_youtube'];
			}
		   else {
		   	$tmp = $db->fetch_item("
                SELECT archivo, url_youtube FROM galerias_contenido AS c
                    JOIN galerias AS g
                        ON g.id = c.id_galeria
                WHERE c.id_galeria=".$g['id']." 
                ORDER BY archivo, titulo");
           if(is_array($tmp)) {
            	$galerias[$key]['archivo'] = $tmp['archivo'];
			   	$galerias[$key]['url_youtube'] = $tmp['url_youtube'];
			}
		   }
        }
    }
 //Limito la busqueda
$TAMANO_PAGINA = 15;

//examino la página a mostrar y el inicio del registro a mostrar
$pagina = isset($_GET["pagina"])?$_GET["pagina"]:null ;
if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}
else {
   $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}
//calculo el total de páginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
$tmp = $db->fetch_all("SELECT * FROM galerias WHERE categoria=2 ORDER BY orden, id desc LIMIT ".$inicio."," . $TAMANO_PAGINA);
    if(is_array($tmp)) {
        $galerias = $tmp;
        foreach($galerias as $key => $g){
            $tmp = $db->fetch_item("
                SELECT archivo, url_youtube FROM galerias_contenido AS c
                    JOIN galerias AS g
                        ON g.id = c.id_galeria
                WHERE c.id_galeria=".$g['id']." and archivo<>''
                ORDER BY archivo, titulo");
           if(is_array($tmp)) {
            	$galerias[$key]['archivo'] = $tmp['archivo'];
			   	$galerias[$key]['url_youtube'] = $tmp['url_youtube'];
			}
		   else {
		   	$tmp = $db->fetch_item("
                SELECT archivo, url_youtube FROM galerias_contenido AS c
                    JOIN galerias AS g
                        ON g.id = c.id_galeria
                WHERE c.id_galeria=".$g['id']." 
                ORDER BY archivo, titulo");
           if(is_array($tmp)) {
            	$galerias[$key]['archivo'] = $tmp['archivo'];
			   	$galerias[$key]['url_youtube'] = $tmp['url_youtube'];
			}
		   }
        }
    }

?>
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Viajes Culturales, instituto de idiomas Educa Idiomas</title>
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
.container-galeria div {

     overflow: hidden;

 }
 .container-galeria img {
     width: auto;
     height: 247px;
     
     vertical-align: middle;
 }
</style>
    </head>
    <body class="body-galeria">

        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-galeria-1.png" alt="" class="firulete-galeria-1">
            <img src="img/firulete-galeria-2.png" alt="" class="firulete-galeria-2">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h1 class="titulo-seccion in-libreria">Viajes Culturales</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="nav nav-pills">
                        <li><a href="galeria.php">Inicio</a></li>
						<li><a href="videos_todos.php">Videos</a></li>
                    </ul>
                </div>
            </div>      
            <div class="row">
                
                <?php             
                        foreach($galerias as $g){                                                   
						echo "<a href='galeria_detalle.php?id=". $g['id']."'>";
								
                		echo "<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                        <div class='container-galeria'>";
                		 if (!empty($g['archivo'])) {
                            echo "<div><img src='uploads/galerias/".$g['id']."/".$g['archivo']."' /></div>";
                        		echo "<p class='descripcion'>".$g['nombre']."</p> </div></div></a>";
						}
							else{
								$cod = explode('=',$g['url_youtube']);
								echo "<div><img src='http://img.youtube.com/vi/".$cod[1]."/0.jpg' /></div>";
                        		echo "<p class='descripcion'>".$g['nombre']."</p> </div></div></a>";
								
							}
                       }
                    ?>
                    
                                  
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <nav class="paginador">
                      <ul class="pagination">
                        
                        <?php  if ($total_paginas > 1) {
   if ($pagina != 1) {
       echo '<li><a href="viajes.php?pagina='.($pagina-1).'"><span aria-hidden="true">Anterior</span></a></li>';
   }
   for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i) {
            //si muestro el índice de la página actual, no coloco enlace
            echo '<li class="active"><a href="#">'.$pagina.'</a></li>'; 
		 } 
         else {
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            echo '<li>  <a href="viajes.php?pagina='.$i.'">'.$i.'</a> </li> ';
            }
   }
      if ($pagina != $total_paginas)
         echo '<li><a href="viajes.php?pagina='.($pagina+1).'"><span aria-hidden="true">Siguiente</span></a></li>';
}?>
                        
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
