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
        <title>Ingles cursos en Mar del Plata EDUCA IDIOMAS</title>
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
            <img src="img/firulete-cursos-ingles-1.png" alt="" class="firulete-cursos-chino-1">
            <img src="img/firulete-cursos-ingles-2.png" alt="" class="firulete-cursos-chino-2">
        </div>
        <?php include("inc-slider.php"); ?>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h1 class="titulo-seccion-tn margin-top-tn">Aprenda Inglés!</h1>
                    <div class="container-iframe float-deskopt">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/TfJ6RlbEAQs?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <p class="bajada-tn margin-bottom">El <span>INSTITUTO EDUCA IDIOMAS</span> dicta los mejores cursos para incrementar tu nivel de inglés de forma natural y progresiva, en un ambiente cálido y distendido, logrando avances desde el primer día tanto en áreas fonéticas como gramaticales, para que alcances tus metas académicas y profesionales en un mundo globalizado. <br>
                    Hoy más que nunca resulta imprescindible aprender el idioma inglés. Cada día se intensifica su empleo en todas las áreas del conocimiento y desarrollo humanos. Prácticamente puede afirmarse que se trata de la lengua del mundo actual. Su posesión ya no puede tratarse como un lujo, sino que es una necesidad evidente. Es más, incluso se dice que quien no domine esta lengua estaría en una clara situación de desventaja. <br>
                    Es por eso que estudiar este idioma es tener concretamente en un futuro mayores y mejores oportunidades.
                    </p> 
                </div>
				 <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:width="110" fb:like:href="https://www.facebook.com/insteducaidiomas?fref=ts"></a>
                <a class="addthis_button_tweet" tw:url="https://twitter.com/EducaIdiomasOK" tw:width="50" ></a>
                </div>
                <script type="text/javascript">var addthis_config = {"data_track_addressbar":};</script>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5076fe221bcbb33a" async="async"></script>
                <!-- AddThis Button END -->
				<div class="addthis_sharing_toolbox"></div>
            </div>
        </div>
        <div class="fluid-container boxes-cursos">
            <div class="arrows-top"></div>
            <div class="arrows-bottom"></div>
            <div class="container-box container-in-ruso">
                <div class="col-1">
                    <img src="img/ft-cursos-ingles-1.jpg" alt="">
                </div>
                <div class="col-2 in-frances">
                    <p class="titulo">Estudiá inglés en Mar del Plata en <span>Educa- Idiomas</span></p>
                    <p class="subtitulo">¿Por qué aprender inglés?</p>
                    <ul>
                        <li><b>Es imprescindible para trabajar</b></li>
                        <li><b>Permite tener acceso a más información</b></li>
                        <li><b>Es el idioma universal.</b></li>
                        <li><b>Te abrirá a nuevas culturas y viajarás sin problemas.</b></li>
                        <li><b>Mejora otras habilidades, amplía metas profesionales.</b></li>
                    </ul>
                </div>
                <div class="col-3">
                    <img src="img/ft-cursos-ingles-2.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-tablas">
                    <h3>Organización de los cursos de inglés:</h3>
                   
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                             <? /*ME METO YO */
                        $tbl = $db->fetch_all('SELECT * FROM tbl_cursos WHERE id_category=56');
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

        <div class="fluid-container boxes-slider in-slider-frances">
            <div class="arrows-top"></div>
            <div class="arrows-bottom"></div>
            <div class="container-slider-en-cursos">
                <div id="owl-demo">
                    <div class="item"><a href="img/ft-slider-ingles-1b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ingles-1.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-ingles-2b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ingles-2.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-ingles-3b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ingles-3.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-ingles-4b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ingles-4.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-ingles-5b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ingles-5.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-ingles-6b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ingles-6.jpg" /></a></div>
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
