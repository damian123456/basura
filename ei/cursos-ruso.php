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
        <title>Aprende ruso cursos Mar del Plata EDUCA IDIOMAS</title>
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
            <img src="img/firulete-cursos-ruso-1.png" alt="" class="firulete-cursos-chino-1">
            <img src="img/firulete-cursos-ruso-2.png" alt="" class="firulete-cursos-chino-2">
        </div>
        <?php include("inc-slider.php"); ?>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h1 class="titulo-seccion-tn margin-top-tn">Aprenda Ruso!</h1>
                    <div class="container-iframe float-deskopt">  
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/ga7n63AhfVY?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <p class="bajada-tn margin-bottom">Rusia es el país con mayor superficie del planeta y su cultura ha marcado durante siglos la historia de la humanidad.<br><br>
Si te gusta la música, el ballet, la arquitectura, literatura y gastronomía de este país, sin dudas conocer su idioma en profundidad te abrirá las puertas a un mundo increíble! 
Rusia es una potencia económica y energética transcontinental, se ha destacado por su excelencia en todas las áreas de conocimiento, ciencias y artes. Aprender ruso te permitirá proyectar nuevos negocios y oportunidades académicas en este gran país.
Si todavía te preguntás sobre los beneficios de aprender ruso, en Educa Idiomas te damos más  razones y herramientas para empezar:
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
        </div>
        <div class="fluid-container boxes-cursos">
            <div class="arrows-top"></div>
            <div class="arrows-bottom"></div>
            <div class="container-box container-in-ruso">
                <div class="col-1">
                    <img src="img/ft-cursos-ruso-1.jpg" alt="">
                </div>
                <div class="col-2 in-ruso">
                    <p class="titulo">Estudiá ruso en Mar del Plata en <span>Educa- Idiomas</span></p>
                    <p class="subtitulo">¿Por qué aprender ruso?</p>
                    <ul>
                        <li><b>El idioma ruso es el quinto más hablado en el mundo.</b> Es un idioma rico y hermoso y el más hablado entre los idiomas eslavos. Hay aproximadamente un total de 300 millones de rusohablantes en todo el mundo.</li>
                        <li><b>Rusia es el país más grande del mundo,</b> ha jugado un importante papel en la historia mundial y sigue haciéndolo actualmente.</li>
                        <li><b>Podrás leer en su idioma original las grandes obras de la literatura rusa.</b> (Dostoyevsky, Chejov, Tolstoi, Turguenev).</li>
                        <li><b>Eres consciente de las oportunidades lucrativas de inversión en Rusia y estás pensando en fundar una empresa allí.</b></li>
                        <li><b>Querés estudiar en prestigiosas universidades de Rusia.</b></li>
                    </ul>
                </div>
                <div class="col-3">
                    <img src="img/ft-cursos-ruso-2.jpg" alt="">
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
                        $tbl = $db->fetch_all('SELECT * FROM tbl_cursos WHERE id_category=112');
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

        <div class="fluid-container boxes-slider in-slider-ruso">
            <div class="arrows-top"></div>
            <div class="arrows-bottom"></div>
            <div class="container-slider-en-cursos">
                <div id="owl-demo">
                    <div class="item"><a href="img/ft-slider-ruso-1b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ruso-1.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-ruso-2b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ruso-2.jpg" /></a></div>
                    <div class="item"><a href="img/ft-slider-ruso-3b.jpg" class="fancybox" rel="gallery"><img src="img/ft-slider-ruso-3.jpg" /></a></div>
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
