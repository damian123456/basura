<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Instituto de idiomas de Mar del plata, Educa Idiomas</title>
        <meta name="description" content="Inglés, portugués, alemán, francés, italiano, chino, japonés, ruso, español">
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
        <script src="js/vendor/modernizr.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/respond.min.js"></script>
          <script src="js/html5.js"></script>
        <![endif]-->

    </head>
    <body>

        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-contacto-1.png" alt="" class="firulete-libreria-1">
        </div>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <h1 class="titulo-seccion-tn less-margin-bottom">Centros tutoriales</h1>
					<p class="text margin-bottom-none">Consulte su representante más cercano.</p><br>
                    <div class="container-mapa">
                        <?/*include("mapa.php");*/?>
                        <iframe src="https://www.google.com/maps/d/embed?mid=zmUopf-obA50.k-SAhFmfiHMM&z=3&output=html" width="607" height="422"></iframe>
                        <!--<img src="img/mapa-representantes.jpg" alt="">-->
                    </div>
                    <p class="bajada-tn">El Instituto <span>Educa Idiomas</span>, junto a Aldeaglobal te permiten estudiar a distancia desde cualquier punto del país. Conocé nuestros centros tutoriales:</p>
				 
                    <div class="panel-group panel-centros-tutoriales" id="accordion" role="tablist" aria-multiselectable="true">
                     <img src="img/filete2-centros.png" alt="" class="firulete-centro2">
                     <img src="img/filete3-centros.png" alt="" class="firulete-centro3">

                     <!-- CABA -->
                        <?$repres = $db->fetch_all('SELECT * FROM representantes ORDER BY id DESC');?>
                          <div class="panel panel-default">
                                  <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Centros Tutoriales Educa idiomas  en CABA
                                      </a>
                                    </h4>
                                  </div>
                          <?foreach ($repres as $re) {
                            if ($re['activo']==1) {
                              if ($re['provincia'] == "Caba" || $re['provincia'] == "CABA" || $re['provincia'] == "Capital" && $re['provincia'] == "Mar del Plata") {?>
                                  <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                      <div class="box2">
                                          <?=$re['nombre']." ".$re['direccion']." ".$re['ciudad'].". Tel. ".$re['telefono']?>
                                      </div>
                                    </div>
                                  </div>
                              <?}
                              }
                            }
                          ?>
                          </div>
                      <!--FIN CABA-->

                      <!--PROVINCIA DE BUENOS AIRES-->
                      <?$represe = $db->fetch_all('SELECT * FROM representantes ORDER BY id DESC'); // BASE DE DATOS CON REPRESENTANTES?>
                        <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                  <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                      Centros Tutoriales Educa idiomas  en la provincia de Buenos Aires
                                    </a>
                                  </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                  <div class="panel-body">
                        <?foreach ($represe as $ree) {
                            if ($ree['activo'] == 1) {
                            if ($ree['provincia'] == "Buenos Aires" && $ree['ciudad']!= "Mar del Plata") {?>
                                    <div class="box2">
                                        <?=$ree['nombre']." ".$ree['direccion']." ".$ree['ciudad'].". Tel. ".$ree['telefono']?>
                                    </div>                                   
                            <?}
                           }
                          }
                        ?>
                                  </div>
                            </div>
                        </div> 
                      <!--FIN PROVINCIA DE BUENOS AIRES-->

                      <!--MENDOZA-->
                      <?$represent = $db->fetch_all('SELECT * FROM representantes ORDER BY id DESC'); // BASE DE DATOS CON REPRESENTANTES?>
                              <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                  <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                      Centros Tutoriales Educa idiomas  en la provincia de Mendoza
                                    </a>
                                  </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                  <div class="panel-body">
                        <?foreach ($represent as $reee) {
                            if ($reee['activo']==1) {
                              if ($reee['provincia'] == "Mendoza") {?>
                                    <div class="box2 con-border">
                                        <?=$reee['nombre']." ".$reee['direccion'].". Tel. ".$reee['telefono']?>
                                    </div>    
                            <?}
                           }
                          }
                        ?>
                                 </div>
                          </div> 
                        </div>
                        <!--FIN MENDOZA-->
                    </div>

                 </div>
				 <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
         <?$cont = true;
              $repre = $db->fetch_all('SELECT * FROM representantes ORDER BY id DESC');
              foreach ($repre as $rep) {
              if($rep['ciudad'] == "Mar del Plata"){
                    if($cont){?>
                    <h4 class="ttl-centros">Instituto EDUCA IDIOMAS en  Mar del Plata</h4>
                    <?$cont = false;
                    }?>
                    <div class="box-blue-centros">
                        <b><?=$rep['nombre']?></b>
                        <p><?=$rep['direccion']?><br>
                        <?=$rep['ciudad']?><br>
                        <?="Tel. ".$rep['telefono']?></p>
                    </div>

            <?}  
            }
        ?>
                    <!--<div class="box-blue-centros">
                        <b>Sede central</b>
                        <p>Av. Juan José Paso 3420 <br>
                        Mar del Plata. Pcia. Buenos Aires, Argentina <br>
                        Tel: 4741380 /4756012</p>
                    </div>
                    <div class="box-blue-centros">
                        <b>Sede Constitución</b>
                        <p>Av. Juan José Paso 3420 <br>
                        Mar del Plata. Pcia. Buenos Aires, Argentina <br>
                        Tel: 4741380 /4756012</p>
                    </div>-->
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
        <script src="js/locations.min.js"></script>
        <script>
          $( ".i4ewOd-pzNkMb-haAclf qAWA2" ).hide();
        </script>
    </body>
</html>
