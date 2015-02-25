<?
    require_once("includes/config.php");

    if (isset($_GET['content'])){

        $id = $_GET['content'];
        $contenido = $db->fetch_item("SELECT * FROM courses WHERE id = $id");
    }

    if (isset($_GET['category'])){

        $id_categoria = $_GET['category'];
        $banners = $db->fetch_all("SELECT * FROM banners WHERE id_categoria = $id_categoria");

    }

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
        
        <script language="javascript" type="text/javascript">
          function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
          }
        </script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/respond.min.js"></script>
          <script src="js/html5.js"></script>
        <![endif]-->

    </head>
    <body>
        <div id="preloader"></div>
        <?php include("inc-header.php"); ?>
<?
        if ($id == 17) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-brasil-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-brasil-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 56) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-ingles-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-ingles-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 57) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-italiano-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-italiano-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 21) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-frances-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-frances-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 23) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-aleman-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-aleman-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 114) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-chino-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-chino-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 117) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-japones-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-japones-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 118) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-ruso-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-ruso-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 22) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-cursos-espanol-1.png" alt="" class="firulete-cursos-chino-1">
                <img style="display: inline;" src="img/firulete-cursos-espanol-2.png" alt="" class="firulete-cursos-chino-2">
            </div>
<?
        }elseif ($id == 94 ) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-brasil-agenda.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-brasil-celpe.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 115) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-empresas1.png" alt="" class="firulete-empresas1">
                <img style="display: inline;" src="img/firulete-empresas2.png" alt="" class="firulete-empresas2">
                <img style="display: inline;" src="img/firulete-empresas3.png" alt="" class="firulete-empresas3">
            </div>
<?
        }elseif ($id == 82) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-examen-italiano-1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-examen-italiano-2.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 79) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-franquicias1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-inglaterra-agenda.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 80) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-examen-toefl-1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-examen-toefl-2.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 69) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-empresas1.png" alt="" class="firulete-empresas1">
                <img style="display: inline;" src="img/firulete-empresas2.png" alt="" class="firulete-empresas2">
                <img style="display: inline;" src="img/firulete-empresas3.png" alt="" class="firulete-empresas3">
            </div>
<?
        }elseif ($id == 78) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-empresas1.png" alt="" class="firulete-empresas1">
                <img style="display: inline;" src="img/firulete-empresas2.png" alt="" class="firulete-empresas2">
                <img style="display: inline;" src="img/firulete-empresas3.png" alt="" class="firulete-empresas3">
            </div>
<?
        }elseif ($id == 77) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-empresas1.png" alt="" class="firulete-empresas1">
                <img style="display: inline;" src="img/firulete-empresas2.png" alt="" class="firulete-empresas2">
                <img style="display: inline;" src="img/firulete-empresas3.png" alt="" class="firulete-empresas3">
            </div>
<?
        }elseif ($id == 71) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-brasil-agenda.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-quienes-4.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 76) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-libreria-1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-inglaterra-agenda.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 74) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-contacto-1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-inglaterra-agenda.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 75) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-franquicias1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-examen-frances-1.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 73) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-japones-examen.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-libreria-2.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 88) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-examen-frances-1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-examen-frances-2.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 70) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-aleman-goethe.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-aleman-goethe-2.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 90) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-examen-chino-1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-examen-chino-2.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 91) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-japones-examen.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-japones-examen-2.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 92) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-examen-espanol-1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-examen-espanol-2.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }elseif ($id == 93) {
?>            
            <div class="content-page">
                <img style="display: inline;" src="img/firulete-examen-italiano-1.png" alt="" class="firulete-libreria-1">
                <img style="display: inline;" src="img/firulete-examen-frances-1.png" alt="" class="firulete-libreria-3">
            </div>
<?
        }else{

?>
        <div class="content-page">
            <img src="img/firulete-empresas1.png" alt="" class="firulete-empresas1">
            <img src="img/firulete-empresas2.png" alt="" class="firulete-empresas2">
            <img src="img/firulete-empresas3.png" alt="" class="firulete-empresas3">
        </div>
<?
        }
?>
        <div class="container container-slider container-slider-empresas">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    
                    
                    <div class="flexslider-empresas">
                        <?
                        /* SLIDER EMPRESAS */
                        $cont = $db->fetch_all('SELECT * FROM courses WHERE id ='.$id);
                        foreach ($cont as $cnt) {
                            if ($cnt['id_category'] == 120) {
                                include("slider-empresas.php");
                            }
                        }
                        /* FIN SLIDER EMPRESAS*/
                        ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">    
            <div class="row">

<?
                if ($id == 72) {
                    $medida = "col-sm-12 col-md-12 col-lg-12";
                }
                else{
                    $medida = "col-sm-8 col-md-8 col-lg-8";
                }
                
?>
                <div class="editor col-xs-12 <?=$medida?>">
                    <iframe src="./editor.php?content=<?=$id?>" frameborder="0" onload='javascript:resizeIframe(this);' style="width:100%"></iframe>
                </div>
<?
                if ($id != 72) {
                    # code...
              
?>

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">


<?
                    if ($banners) {
                        foreach ($banners as $b) {
                        
                            if(!$b['url_youtube']){    
    ?>
                                <div class="foto-empresas">
                                    <img src="uploads/<?=$b['archivo']?>" alt="">
                                </div>
    <?
                            }else{  
                                $pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
                                $youtube_id = (preg_replace($pattern, '$1', $b['url_youtube']));
    ?>
                                <div class="foto-empresas">
                                    <iframe width="100%" class="img-responsive" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                                
    <?                      }

                        }
                    }elseif ($id == 94) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://portal.mec.gov.br/index.php?option=com_content&amp;id=12270&amp;Itemid=518" target="_blank"><img src="img/celpe-bras.jpg" alt="">
                        </a></div>
<?
                    }elseif ($id == 79) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://www.cambridgeenglish.org/es/exams-and-qualifications/first/" target="_blank"><img src="img/fce.jpg" alt="">
                        </a></div>
<?
                    }elseif ($id == 80) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://www.ets.org/toefl" target="_blank"><img src="img/toefl.jpg" alt="">
                        </a></div>
<?
                    }elseif ($id == 82) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://cils.unistrasi.it/" target="_blank"><img src="img/CILS5.jpg" alt="">
                        </a></div>
<?
                    }elseif ($id == 88) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://www3.ciep.fr/travaux/index.html" target="_blank"><img src="img/delf.gif" alt="">
                        </a></div>
<?
                    }elseif ($id == 70) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://www.goethe.de/lrn/prj/pba/bes/esindex.htm" target="_blank"><img src="img/goethe.jpg" alt="">
                        </a></div>
<?
                    }elseif ($id == 90) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://www.cii.ie/cn/index.php/2014-03-07-17-53-48/hsk" target="_blank"><img src="img/hsk-logo.jpg" alt="">
                        </a></div>
<?
                    }elseif ($id == 91) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://www.jlpt.jp/index.html" target="_blank"><img src="img/examen-japones.jpg" alt="">
                        </a></div>
<?
                    }elseif ($id == 92) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <a href="http://www.celu.edu.ar/" target="_blank"><img src="img/celu.jpg" alt="">
                        </a></div>
<?
                    }elseif ($id == 69) {
?>
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
<?
                    }elseif ($id == 77) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <img src="img/traducciones-mardelplata-1.jpg" alt="">
                        </div>
                        <div class="foto-empresas">
                            <img src="img/traducciones-mardelplata-2.jpg" alt="">
                        </div>
                        <div class="foto-empresas">
                            <img src="img/traducciones-educaidiomas-3.jpg" alt="">
                        </div>
<?
                    }elseif ($id == 78) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <img src="img/interpretes-en-vivo-mardelplata.jpg" alt="">
                        </div>
                        <div class="foto-empresas">
                            <img src="img/interpretes-idiomas-mardelplata-2.jpg" alt="">
                        </div>
<?
                    }elseif ($id == 71) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <img src="img/nivelacion.jpg" alt="">
                        </div>
<?
                    }elseif ($id == 73) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <img src="img/tutorias.jpg" alt="">
                        </div>
<?
                    }elseif ($id == 74) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <img src="img/curso-colegios1.jpg" alt="">
                        </div>
                        <div class="foto-empresas">
                            <img src="img/curso-colegios-2.jpg" alt="">
                        </div>
<?
                    }elseif ($id == 75) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <img src="img/apoyo-universidades.jpg" alt="">
                        </div>
<?
                    }elseif ($id == 76) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <img src="img/apoyo-escolar.jpg" alt="">
                        </div>
                        <div class="foto-empresas">
                            <img src="img/apoyo-ingreso-universidad-2.jpg" alt="">
                        </div>
<?
                    }elseif ($id == 93) {
?>
                        <div class="foto-empresas foto-empresas-top">
                            <img src="img/biblioteca-educaidiomas.jpg" alt="">
                        </div>
<?
                    }
                    
?>
                    
                </div>
<?
                }
?>
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
 