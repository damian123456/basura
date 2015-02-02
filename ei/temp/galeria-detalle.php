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
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>

        <link rel="apple-touch-icon" href="images/favicon.png"/>
        <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/respond.min.js"></script>
          <script src="js/html5.js"></script>
        <![endif]-->

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
                    <h1 class="titulo-seccion in-libreria">Galeria</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="nav nav-pills">
                        <li><a href="fotos.php">Fotos</a></li>
                        <li><a href="videos.php">Videos</a></li>
                        <li><a href="fotos.php">Viajes Culturales</a></li>
                        <li><p class="titulo-galeria">Clase Especial Primavera</p></li>
                    </ul>
                </div>
            </div>      
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="img/galeria1.jpg" data-fancybox-group="gallery" class="fancybox">
                        <div class="container-galeria in-detalle">
                            <img src="img/galeria1.jpg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="img/galeria2.jpg" data-fancybox-group="gallery" class="fancybox">
                        <div class="container-galeria in-detalle">
                            <img src="img/galeria2.jpg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="img/galeria3.jpg" data-fancybox-group="gallery" class="fancybox">
                        <div class="container-galeria in-detalle">
                            <img src="img/galeria3.jpg" alt="">
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="img/galeria3.jpg" data-fancybox-group="gallery" class="fancybox">
                        <div class="container-galeria in-detalle">
                            <img src="img/galeria3.jpg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="img/galeria1.jpg" data-fancybox-group="gallery" class="fancybox">
                        <div class="container-galeria in-detalle">
                            <img src="img/galeria1.jpg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="img/galeria2.jpg" data-fancybox-group="gallery" class="fancybox">
                        <div class="container-galeria in-detalle">
                            <img src="img/galeria2.jpg" alt="">
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <nav class="paginador">
                      <ul class="pagination">
                        <li><a href="#"><span aria-hidden="true">Anterior</span></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span aria-hidden="true">Siguiente</span></a></li>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
