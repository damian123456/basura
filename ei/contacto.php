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
        <link href='http://fonts.googleapis.com/css?family=Asap:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="css/owl.carousel.css" rel="stylesheet">
        <link rel="stylesheet" href="css/owl.theme.css" rel="stylesheet">
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

        <div class="content-page in-contacto">
            <img src="img/firulete-contacto-1.png" alt="" class="firulete-brasil">
            
        </div>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <h1 class="titulo-seccion-tn">Contacto</h1>
                                       
                    <form action="enviar.php" method="post" id="form" role="form" class="form-franquicias">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido *" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email *" required><input name="ok" type="hidden" id="ok" value="1">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required>
                        </div>
                        <div class="form-group">
                            <select class="mySelectBoxClass" id="idioma" name="idioma" tabindex="1">
                                <option value="" disabled selected >Idioma *</option>
                                <option value="ruso">Portugués</option>
                                <option value="ingles">Inglés</option>
                                <option value="portugues">Francés</option>
                                <option value="portugues">Chino</option>
                                <option value="portugues">Japón</option>
                                <option value="portugues">Alemán</option>
                                <option value="portugues">Español</option>
                                <option value="portugues">Ruso</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="comentarios" id="comentarios" class="form-control" placeholder="Comentarios *"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-franquicias">ENVIAR MENSAJE</button>
                    </form>
                </div>
				<div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                    <div class="foto-empresas foto-empresas-top">
                        <img src="img/contacto.jpg" alt="">
                    </div>
			</div>
            </div>
				
			<div class="row">
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                    <div class="container-foto-mapa">
                        <img src="img/sucursal-paso.jpg" alt="">
                        <p>Sede Central. Av. Juan j. Paso 3420</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                    <div class="container-foto-mapa">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3143.3658296445924!2d-57.5714186!3d-38.01525009999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9584debe42629605%3A0xb4803495e76553af!2sAv+Juan+Jos%C3%A9+Paso+3420%2C+Mar+del+Plata%2C+Buenos+Aires!5e0!3m2!1ses!2sar!4v1418252986606" width="600" height="450" frameborder="0" style="border:0"></iframe>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                    <div class="container-foto-mapa">
                        <img src="img/sucursal-constitucion.jpg" alt="">
                        <p>Sede Constitución. Av. Constitución 5111</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                    <div class="container-foto-mapa">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3145.520274275285!2d-57.554767399999996!3d-37.964985899999995!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9584d962c5bdb509%3A0x8a3d21f59d34ffec!2sAv+Constituci%C3%B3n+5111%2C+Mar+del+Plata%2C+Buenos+Aires!5e0!3m2!1ses!2sar!4v1418253025241" width="600" height="450" frameborder="0" style="border:0"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 in-home">
                    <?php include("inc-banderas.php"); ?>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
