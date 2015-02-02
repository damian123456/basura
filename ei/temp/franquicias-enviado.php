<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Franquicias</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Asap:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
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
    <body>

        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-franquicias1.png" alt="" class="firulete-franquicias1">
            <img src="img/firulete-franquicias2.png" alt="" class="firulete-franquicias2">
        </div>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <h1 class="titulo-seccion-tn">Tené tu franquicia!</h1>
                    <p class="bajada-tn">El Instituto <span>Educa Idiomas</span> es uno de los institutos de idiomas más importantes en la enseñanza de idiomas en la ciudad de Mar del Plata, dentro de la Provincia de Buenos Aires, y el único en la zona, que brinda cursos de aprendizaje de nueve idiomas y servicios de apoyo a institutos o profesores particulares que deseen desarrollarse aún más en esta área: Portugués, Español para Extranjeros, Francés, Italiano, Alemán, Inglés, Ruso, Japonés y Chino. Tanto presencial como virtual, de manera online, dentro de todo el territorio nacional. <br> 
                    Si estás relacionado con la enseñanza de lenguas extranjeras o te interesa sumarte al Instituto Educa Idiomas desde tu ciudad como franquicia, podés hacerlo inmediatamente y con estas ventajas: </p>
                    <div class="box rojo">
                        <p class="titulin">Baja inversión</p>
                        <p>No requiere demasiada experiencia.</p>
                        <p>El Instituto Educa Idiomas brinda:</p>
                        <ul>
                            <li>Asesoramiento en las instalaciones requeridas.</li>
                            <li>Asesoramiento en cuanto al personal docente y administrativo  necesario.</li>      
                            <li>Experiencia docente.</li>
                            <li>Coordinación de los cursos.</li>
                            <li>Capacitación docente, apoyo pedagógico y operativo.</li>
                            <li>Orientación en el sistema de gestión.</li>
                            <li>Acceso a plataforma virtual.</li>
                            <li>Participación de los alumnos en cursos, eventos culturales, seminarios, talleres, conferencias.</li>
                            <li>Certificados de Estudios para todos los niveles por Instituto Educa Idiomas.</li>
                            <li>Orientación para exámenes internacionales.</li>
                            <li>Folletería, herramientas de marketing, publicidad institucional.</li>
                        </ul>
                    </div>
                    <p class="text-bold margin-bottom-none">¿Necesitas más información?</p>
                    <p class="bajada-tn">Si necesitás más información, por favor, completá el siguiente formulario y te contactaremos en breve.</p>

                    <form action="enviar-franquicia.php" method="post" id="form" role="form" class="form-franquicias">
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
                                <option value="ruso">Portugues</option>
                                <option value="ingles">Ingles</option>
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
                    <p class="mensaje-enviado">Su mensaje se ha enviado con éxito. Muchas gracias!</p>

                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="foto-empresas foto-empresas-top">
                        <img src="img/ft-franquicia.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php include("inc-banderas.php"); ?>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
