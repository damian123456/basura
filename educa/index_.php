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
        <title>Educa Idiomas</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Asap:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>

        <link rel="apple-touch-icon" href="img/favicon.ico"/>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/respond.min.js"></script>
          <script src="js/html5.js"></script>
        <![endif]-->

    </head>
    <body>

        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-italia.png" alt="" class="firulete-italia">
            <img src="img/firulete-argentina.png" alt="" class="firulete-argentina">
            <img src="img/firulete-francia.png" alt="" class="firulete-francia">
            <img src="img/firulete-brasil.png" alt="" class="firulete-brasil">
            <img src="img/firulete-inglaterra.png" alt="" class="firulete-inglaterra">
            <img src="img/firulete-alemania.png" alt="" class="firulete-alemania">
        </div>
        <div class="container container-slider">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="img/slider.png" alt="">
                                <a href="#">
                                    <div class="container-caption">
                                        <img src="img/anotate.png" alt="" class="point">
                                        <div class="caption">
                                            <p>Clases de Inglés para adolescentes</p>
                                            <span>Educa-Idiomas, el instituto de inglés de Mar del Plata</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <img src="img/slider.png" alt="">
                                <a href="#">
                                    <div class="container-caption">
                                        <img src="img/anotate.png" alt="" class="point">
                                        <div class="caption">
                                            <p>Clases de Inglés para adolescentes</p>
                                            <span>Educa-Idiomas, el instituto de inglés de Mar del Plata</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <img src="img/slider.png" alt="">
                                <a href="#">
                                    <div class="container-caption">
                                        <img src="img/anotate.png" alt="" class="point">
                                        <div class="caption">
                                            <p>Clases de Inglés para adolescentes</p>
                                            <span>Educa-Idiomas, el instituto de inglés de Mar del Plata</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <img src="img/slider.png" alt="">
                                <a href="#">
                                    <div class="container-caption">
                                        <img src="img/anotate.png" alt="" class="point">
                                        <div class="caption">
                                            <p>Clases de Inglés para adolescentes</p>
                                            <span>Educa-Idiomas, el instituto de inglés de Mar del Plata</span>
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
                         <div class="clear"></div>
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:width="110" fb:like:href="https://www.facebook.com/educaidiomas.instituto?ref=ts&fref=ts"></a>
                        <a class="addthis_button_tweet" tw:url="https://twitter.com/EducaIdiomasOK" tw:width="50" ></a>
                        </div>
                        <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                        <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5076fe221bcbb33a"></script>
                        <!-- AddThis Button END -->
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <p>educa-idiomas</p>
                        <span>es un instituto de enseñanza  ubicado en Mar del Plata, Argentina. Ofrecemos la mejor formación académica para que puedas aprender portugués, inglés, francés, italiano, alemán, chino, ruso, japonés  y español para extranjero. Nuestros cursos abarcan todas las edades y niveles, clases presenciales y a distancia. </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 in-home">
                    <?php include("inc-banderas.php"); ?>
                </div>
            </div>
            <div class="row">
                <?$banner_horizontal = $db->fetch_all('SELECT * FROM banhor ORDER BY id DESC');
                foreach($banner_horizontal as $bann){
                    if($bann['activo']=1){?>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <a href="<?echo $bann['link']?>">
                        <div class="call-to-action">
                            <div class="content-call">
                                <div class="more">+</div>
                                <p><?echo $bann['titulo']?></p>
                                <span><?echo $bann['contenido']?></span>
                            </div>
                            <img src="uploads/<? echo $bann['imagen']?>" alt="">
                        </div>
                    </a>
                </div>
                <?} 
            }?>
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
                    <?$banner_vertical = $db->fetch_all('SELECT * FROM banver ORDER BY id DESC');
                    foreach($banner_vertical as $ban){
                        if($ban['activo']=1){?>
                            <a href="<? echo $ban['link']?>" class="bancos"><img src="uploads/<? echo $ban['imagen']?>" alt=""></a>
                        <?}?>

                    <!--LA ULTIMA
                    <a href="" class="bancos last"><img src="img/tarjetas-1.jpg" alt=""></a>-->
                    <?}?>

                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
