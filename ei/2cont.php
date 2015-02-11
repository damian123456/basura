<?php
  /* AGREGO*/
    require_once("/includes/config.php");//agregue
    
    $action = $_REQUEST['action'];
    $id = intval($_REQUEST['id']);

    if($id){
        $item = $db->fetch_item("SELECT * FROM courses WHERE id=$id");
    }
    /*FIN AGREGO*/
    ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Educa Idiomas, cursos de idiomas para empresas en Mar del Plata</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Asap:400,400italic,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
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

    </head>
    <body>
        <div id="preloader"></div>
        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-empresas1.png" alt="" class="firulete-empresas1">
            <img src="img/firulete-empresas2.png" alt="" class="firulete-empresas2">
            <img src="img/firulete-empresas3.png" alt="" class="firulete-empresas3">
        </div>
        <div class="container container-slider container-slider-empresas">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <!--AGREGO: SLIDER EMPRESAS-->
                    <div class="flexslider-empresas">
                    <?if ($empresas){
                        include("slider-empresas.php");
                    }?>
                    </div>
                    <!--FIN AGREGO: SLIDER EMPRESAS-->
                </div>
            </div>
        </div>
        <div class="container">    
            <div class="row">

            <? //AGREGO: SWITCH ACTION

            switch($action){
                case 'empresas': // Si estamos agregando un nuevo banner mostramos el formulario
                    include 'content/emp.php'; 
                    break;
            }
            //FIN AGREGO: SWITCH ACTION?>

                <!--<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="foto-empresas foto-empresas-top">
                        <img src="img/empresas1.jpg" alt="">
                    </div>
                    <div class="foto-empresas">
                        <img src="img/empresas2.jpg" alt="">
                    </div>
                    <div class="foto-empresas">
                        <img src="img/empresas3.jpg" alt="">
                    </div>
                    <div class="foto-empresas">
                        <img src="img/empresas4.jpg" alt="">
                    </div>
                </div>-->
            </div>
			<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="contacto.php" class="btn btn-franquicias in-tablas">SU CONSULTA NOS INTERESA</a>
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
