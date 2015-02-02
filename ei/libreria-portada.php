<? include('includes/config.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
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

        <link rel="apple-touch-icon" href="img/favicon.ico"/>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>

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
                    <h1 class="titulo-seccion in-libreria">Librería</h1>
                    <p class="bajada">La librería del instituto cuenta  con textos a la venta en todos los idiomas, para los alumnos, profesores y público en general.  Allí también podrás encontrar música entre los cuentos y la literatura, CD’s, DVD’s,  novelas, libros infantiles, diccionarios, material didáctico, revistas y textos para la enseñanza de idiomas extranjeros, entre otros. 
                    Somos el único instituto de la ciudad que brinda el servicio de venta de material relacionado a idiomas extranjeros, abierto al público en general.</p>
                </div>
            </div>
        </div> 
        <div class="container-fluid in-libreria">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?/*
                $categorias = $db->fetch_all('SELECT * FROM categorias_libros ORDER BY id');
                $i = 0;
                foreach ($categorias as $c){

                    $hijos = $db->fetch_all("SELECT * FROM libreria WHERE categoria = {$c['id']}");
                    if (count($hijos) > 0){ 

                        $nombre = $c['nombre'];
                        $nombre = str_replace("á", "a", $nombre);
                        $nombre = str_replace("é", "e", $nombre);
                        $nombre = str_replace("í", "i", $nombre);
                        $nombre = str_replace("ó", "o", $nombre);
                        $nombre = str_replace("ú", "u", $nombre);
                        $nombre = str_replace("Á", "A", $nombre);
                        $nombre = str_replace("É", "E", $nombre);
                        $nombre = str_replace("Í", "I", $nombre);
                        $nombre = str_replace("Ó", "O", $nombre);
                        $nombre = str_replace("Ú", "U", $nombre);





 ?>                   

                        <div class="container-categoria">
                            <a href="libreria.php?categoria=<?=$nombre?>">
                                <p><?=strtoupper($nombre)?></p>
                                <img src="img/<?=$i?>.png" alt="" class="contenedor">
                                <span class="libros"><img src="img/libros-<?=strtolower($nombre)?>.png" alt=""></span>
                            </a>
                        </div>
<?
                    $i++;
                    $i = $i % 6;
                    }
                }
*/?>
                    <div class="container-categoria">
                        <a href="libreria.php?categoria=Novedades">
                            <p>NOVEDADES</p>
                            <img src="img/0.png" alt="" class="contenedor">
                            <span class="libros"><img src="img/libros-novedades.png" alt=""></span>
                        </a>
                    </div>

                    <div class="container-categoria">
                        <a href="libreria.php?categoria=Diccionarios">
                            <p>DICCIONARIOS</p>
                            <img src="img/1.png" alt="" class="contenedor">
                            <span class="libros"><img src="img/libros-diccionarios.png" alt=""></span>
                        </a>
                    </div>

                    <div class="container-categoria">
                        <a href="libreria.php?categoria=Literatura">
                            <p>LITERATURA</p>
                            <img src="img/2.png" alt="" class="contenedor">
                            <span class="libros"><img src="img/libros-literatura.png" alt=""></span>
                        </a>
                    </div>

                    <div class="container-categoria verde-margin">
                        <a href="libreria.php?categoria=Cuentos Infantiles">
                            <p>CUENTOS INFANTILES</p>
                            <img src="img/3.png" alt="" class="contenedor">
                            <span class="libros"><img src="img/libros-cuentos infantiles.png" alt=""></span>
                        </a>
                    </div>

                    <div class="container-categoria">
                        <a href="libreria.php?categoria=Música Cds y Dvds">
                            <p>MUSICA CDS Y DVDS</p>
                            <img src="img/4.png" alt="" class="contenedor">
                            <span class="libros"><img src="img/libros-musica cds y dvds.png" alt=""></span>
                        </a>
                    </div>

                    <div class="container-categoria">
                        <a href="libreria.php?categoria=Material Didáctico">
                            <p>MATERIAL DIDACTICO</p>
                            <img src="img/5.png" alt="" class="contenedor">
                            <span class="libros"><img src="img/libros-material didactico.png" alt=""></span>
                        </a>
                    </div>
                   
                    
                </div>
            </div>      
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="contacto.php" class="btn btn-franquicias in-tablas">SU CONSULTA NOS INTERESA</a>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
