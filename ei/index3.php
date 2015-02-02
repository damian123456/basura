<?
    require_once("includes/config.php");//agregue 
    function convert($date){
        $date = date("M j, Y", strtotime($date));
        return $converteddate;

    }
        
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Instituto de idiomas Mar del Plata EDUCA IDIOMAS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Asap:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
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
             <img src="img/firulete-argentina.png" alt="" class="firulete-argentina">
            <img src="img/firulete-francia.png" alt="" class="firulete-francia">
            <img src="img/firulete-brasil.png" alt="" class="firulete-brasil">
            <img src="img/firulete-inglaterra.png" alt="" class="firulete-inglaterra">
			
            
        </div>
        <div class="container container-slider">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="img/curso-idiomas-2015-ninos-2.jpg" alt="">
                                <a href="contacto.php">
                                    <div class="container-caption">
                                        <img src="img/anotate.png" alt="" class="point">
                                        <div class="caption">
                                            <p>Cursos idiomas para niños 2015</p>
                                            <span>Matrícula $50. Todos los idiomas a partir de los 3 años!</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <img src="img/curso-idiomas-2015-adultos.jpg" alt="">
                                <a href="contacto.php">
                                    <div class="container-caption">
                                        <img src="img/anotate.png" alt="" class="point">
                                        <div class="caption">
                                            <p>Cursos regulares 2015 para adultos</p>
                                            <span>Vení con un amig@ y obtené 50% OFF en tu matrícula!</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <img src="img/curso-idiomas-2015-adolescentes.jpg" alt="">
                                <a href="contacto.php">
                                    <div class="container-caption">
                                        <img src="img/anotate.png" alt="" class="point">
                                        <div class="caption">
                                            <p>Descuentos para adolescentes 2015</p>
                                            <span>Matrícula de inscripción $70 en todos los idiomas!</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <img src="img/curso-idiomas-2015-ninos.jpg" alt="">
                                <a href="contacto.php">
                                    <div class="container-caption">
                                        <img src="img/anotate.png"" alt="" class="point">
                                        <div class="caption">
                                            <p>Cursos para niños desde los 3 años!</p>
                                            <span>Cursos en todos los idiomas!</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">    
            <div class="row">
                <div class="container-educa-idiomas">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                        <div class="container-iframe">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/p5UfZIGALwg?rel=0" frameborder="0" allowfullscreen></iframe>  
						</div>
						<br>
						<div class="clear"></div>
					<!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:width="110" fb:like:href="https://www.facebook.com/insteducaidiomas?fref=ts"></a>
                <a class="addthis_button_tweet" tw:url="https://twitter.com/EducaIdiomasOK" tw:width="50" ></a>
                </div>
                <script type="text/javascript">var addthis_config = {"data_track_addressbar":};</script>
                <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5076fe221bcbb33a"></script>
                <!-- AddThis Button END -->
                    </div>
						
                	
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <p>Educa-idiomas</p>
                        <span>Es un instituto de enseñanza  ubicado en Mar del Plata, Argentina. Ofrecemos la mejor formación académica para que puedas aprender portugués, inglés, francés, italiano, alemán, chino, ruso, japonés  y español para extranjero. Nuestros cursos abarcan todas las edades y niveles, clases presenciales y a distancia. </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 in-home">
                    <?php include("inc-banderas.php"); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <a href="nivelacion.php">
                        <div class="call-to-action">
                            <div class="content-call">
                                <div class="more">+</div>
                                <p>Nivelación Gratuita</p>
                                <span>Conocé tu nivel</span>
                            </div>
                            <img src="img/ft-call-to-action1.jpg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <a href="libreria-portada.php">
                        <div class="call-to-action">
                            <div class="content-call">
                                <div class="more">+</div>
                                <p>Librería Idiomas</p>
                                <span>Abierta al público</span>
                            </div>
                            <img src="img/ft-call-to-action2.jpg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <a href="empresas.php">
                        <div class="call-to-action">
                            <div class="content-call">
                                <div class="more">+</div>
                                <p>Cursos para empresas</p>
                                <span>Personalizados</span>
                            </div>
                            <img src="img/ft-call-to-action3.jpg" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <a href="traducciones.php">
                        <div class="call-to-action">
                            <div class="content-call">
                                <div class="more">+</div>
                                <p>Traducciones</p>
                                <span>Todos los idiomas</span>
                            </div>
                            <img src="img/ft-call-to-action4.jpg" alt="" width="102" height="70">
                        </div>
                    </a>
                </div>
            </div>
            <div class="row padding-bottom-top">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 relative-novedades">
                  <img src="img/ttl-novedades.png" alt="" class="ttl-novedades">
                  <div class="container-novedades">

                     <?/* ME METO YO */
                        $nov = $db->fetch_all('SELECT * FROM noticias ORDER BY id DESC');
                    /* FIN YO */

                    $cont=0;
                    
                    foreach($nov as $n){

                        $mes_nombre = date('F', strtotime($n['added']));

                        
                        if($mes_nombre=='January') $mes_nombre='de Enero';
                        if($mes_nombre=='February') $mes_nombre='de Febrero';
                        if($mes_nombre=='March') $mes_nombre='de Marzo';
                        if($mes_nombre=='April') $mes_nombre='de Abril';
                        if($mes_nombre=='May') $mes_nombre='de Mayo';
                        if($mes_nombre=='June') $mes_nombre='de Junio';
                        if($mes_nombre=='July') $mes_nombre='de Julio';
                        if($mes_nombre=='August') $mes_nombre='de Agosto';
                        if($mes_nombre=='September') $mes_nombre='de Septiembre';
                        if($mes_nombre=='October') $mes_nombre='de Octubre';
                        if($mes_nombre=='November') $mes_nombre='de Noviembre';
                        if($mes_nombre=='December') $mes_nombre='de Diciembre';

                        if($cont>0){
                            $primera="";
                        }else{
                           $primera="first";
                        }


                        if($n['activo']=1){
                        ?>

                        <div class="container-novedad <?echo $primera?>">
                            
                            <div class="box-imagen">
                                <img src="uploads/<? echo $n['imagen']?>" alt="" width="102" height="69">
                            </div>
                            <div class="box-info">
                                
                                <p class="ttl"><?echo $n['titulo']?></p>
                                <small><?echo date('j', strtotime($n['added'])).' '.$mes_nombre;?></small>
                                <div class="more-less">
                                    <div class="more-block">
                                        <?
                                        $cadenas=explode(" ",$n['contenido']);
                                                                               
                                        ?>

                                        <p><?

                                        $cant_palabras = 20;

                                        for ($i=0; $i < $cant_palabras ; $i++) {  echo $cadenas[$i].' '; }

                                        if(count($cadenas) > $cant_palabras){
?>                                            
                                            <a class="read-more-show hide" href="#">Leer mas +</a>
                                        

                                            <span class="read-more-content">

<?                                              $i=0;
                                                foreach ($cadenas as $c) {
                                                    if($i>=$cant_palabras){
                                                        echo $c.' ';
                                                    }
                                                    $i++;
                                                }
?>


                                            <a class="read-more-hide hide" href="#">Cerrar</a></span></p>
<?
                                        $cont++;
                                        }
?>
                                        
                                        
                                    </div>
                                    
                                </div>


                            </div>
                        </div>
                        <?}?>
                        <?}?>

                  </div>  
                
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <a href="http://educaidiomas.com.ar/examenes-celpe-bras.php" class="bancos"><img src="img/EXAMENES.jpg" alt=""></a>
                    <a href="http://educaidiomas.com.ar/franquicias.php" class="bancos"><img src="img/franquicia-2.jpg" alt=""></a>
                    <a href="http://educaidiomas.com.ar/cursos-online.php" class="bancos"><img src="img/ONLINE2.jpg" alt=""></a>
                    <a href="https://www.facebook.com/insteducaidiomas?fref=ts" target="_blank" class="bancos last"><img src="img/ACB-2.jpg" alt=""></a>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
