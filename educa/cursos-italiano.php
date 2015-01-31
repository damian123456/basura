<?
    require_once("includes/config.php");//agregue 
        
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Cursos italiano en Mar del Plata EDUCA IDIOMAS</title>
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
        <div id="preloader"></div>
        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-cursos-italiano-1.png" alt="" class="firulete-cursos-chino-1">
            <img src="img/firulete-cursos-italiano-2.png" alt="" class="firulete-cursos-chino-2">
        </div>
        <?php include("inc-slider.php"); ?>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h1 class="titulo-seccion-tn margin-top-tn">Aprenda Italiano!</h1>
                    <div class="container-iframe float-deskopt">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/ha5q2JflOGg?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <p class="bajada-tn margin-bottom">El Italiano es dictado en el <span>INSTITUTO EDUCA IDIOMAS</span>, con los niveles que corresponden al Marco Común Europeo de Referencia (MCER). <br> <br>
                    Pensar en aprender un idioma es pensar en nuestro futuro. El mercado laboral nos exige estar cada vez mas capacitados y aprender italiano es una herramienta valiosa para muchas empresas que crecen en el mercado europeo. <br><br>
                    Este curso le ofrece la posibilidad de introducirse en el conocimiento de la lengua italiana, permitiéndole obtener una base gramatical sólida y un vocabulario extenso. <br> <br>
Conoce este hermoso país que desde el Imperio Romano, pasando por el Renacimiento y en la actualidad ha definido y moldeado la cultura del mundo occidental.  <br> <br>
Aprende sobre su gastronomía, música, arquitectura y espectaculares destinos turísticos!
					<br> <br>
                    </p> 
                </div>
				 <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:width="110" fb:like:href="https://www.facebook.com/insteducaidiomas?fref=ts"></a>
                <a class="addthis_button_tweet" tw:url="https://twitter.com/EducaIdiomasOK" tw:width="50" ></a>
                </div>
                <script type="text/javascript">var addthis_config = {"data_track_addressbar":};</script>
                <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5076fe221bcbb33a"></script>
                <!-- AddThis Button END -->
            </div>
        </div>
        <div class="fluid-container boxes-cursos">
            <div class="arrows-top"></div>
            <div class="arrows-bottom"></div>
            <div class="container-box container-in-ruso">
                <div class="col-1">
                    <img src="img/ft-cursos-italiano-1.jpg" alt="">
                </div>
                <div class="col-2 in-italiano">
                    <p class="titulo">Estudiá italiano en Mar del Plata en <span>Educa- Idiomas</span></p>
                    <p class="subtitulo">¿Por qué aprender italiano?</p>
                    <ul>
                        <li><b>Porque es un idioma hablado alrededor de todo el mundo. 62 millones de hablantes, quinta lengua más estudiada en los cinco continentes e idioma oficial en 5 países.</b> El italiano no sólo se habla en Italia, es además lengua oficial en Suiza, San Marino, Libia y Vaticano; y tiene una fuerte presencia en más de una veintena de países.</li>
                        <li><b>Porque es fácil de aprender y es la lengua de nuestras raíces inmigrantes.</b></li>
                        <li><b>Porque está muy bien valorado en el ámbito empresarial.</b> 6 de las 100 mayores empresas globales tienen su sede en Italia y un mayor número de ellas disponen de filiales alrededor del mundo. </li>
                        <li><b>Porque te servirá para conocer mundo.</b></li>
                        <li><b>Porque es el idioma del arte y la cultura.</b></li>
                    </ul>
                </div>
                <div class="col-3">
                    <img src="img/ft-cursos-italiano-2.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-tablas">
                    <h3>Organización de los cursos:</h3>
                  
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <? /*ME METO YO */
                        $tbl = $db->fetch_all('SELECT * FROM tbl_cursos WHERE id_category=57');
                $cont=0;
                

                $default = "";                  
                foreach($tbl as $t){
                    if($cont>0){
                        $clase="";
                    }else{
                        $default = $t['title'];
                        $clase="active";
                    }                                             
                        ?> 

                        <li role="presentation" class="<?echo $clase?>"><a href="#<?echo str_replace(' ', '-', $t['title'])?>" aria-controls="<?echo $t['title']?>" role="tab" data-toggle="tab"><?echo $t['title']?></a></li>
                        <?
                        $cont=$cont+1;
                        }


                        ?>
                        </ul>

                        <div class="tab-content">
                            <?include("templates/tablas.php");?> 
                        </div>

                    </div>
                    <a href="contacto.php" class="btn btn-franquicias in-tablas">SU CONSULTA NOS INTERESA</a>
                </div>
            </div>
        </div>

        <div class="fluid-container boxes-slider in-slider-italiano">
            <div class="arrows-top"></div>
            <div class="arrows-bottom"></div>
            <div class="container-slider-en-cursos">
                <div id="owl-demo">
                    <div class="item"><a href="img/ft-slider-italiano-1b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-italiano-1.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-italiano-2b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-italiano-2.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-italiano-3b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-italiano-3.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-italiano-4b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-italiano-4.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-italiano-5b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-italiano-5.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-italiano-6b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-italiano-6.jpg" /></a></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php include("inc-banderas.php"); ?>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
