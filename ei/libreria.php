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
        <title>Educa Idiomas</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style2.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>

        <link rel="apple-touch-icon" href="img/favicon.ico"/>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>

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

        <div class="content-page">
            <img src="img/firulete-libreria-1.png" alt="" class="firulete-libreria-1">
            <img src="img/firulete-libreria-2.png" alt="" class="firulete-libreria-2">
            <img src="img/firulete-libreria-3.png" alt="" class="firulete-libreria-3">
            <img src="img/firulete-libreria-4.png" alt="" class="firulete-libreria-4">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h1 class="titulo-seccion in-libreria">Librería</h1>
                    <p class="bajada">La librería del instituto cuenta  con textos a la venta en todos los idiomas, para los alumnos, profesores y público en general.  Allí también podrás encontrar música entre los cuentos y la literatura, CD’s, DVD’s,  novelas, libros infantiles, diccionarios, material didáctico, revistas y textos para la enseñanza de idiomas extranjeros, entre otros. 
                    Somos el único instituto de la ciudad que brinda el servicio de venta de material relacionado a idiomas extranjeros, abierto al público en general.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="nav nav-pills">
<?
                    $categorias = $db->fetch_all("SELECT * FROM categorias_libros ORDER BY id");
                    $i = 0;                        
                    $clase = '';
                    foreach($categorias as $c){
                        $hijos = $db->fetch_all("SELECT * FROM libreria WHERE categoria = {$c['id']}");
                        if (count($hijos) > 0){
                            $i++;
                            if (isset($_GET['categoria']) && !empty($_GET['categoria'])){
                    
                                if($_GET['categoria'] == $c['nombre']){
                                    $clase = 'class="active"';
                                }
                                else{
                                    $clase = '';
                                }
                            }
                            else{
                                if ($i == 1){
                                    $clase = 'class="active"';
                                }
                                else{
                                    $clase = '';
                                }
                            }
                            echo '<li role="presentation"'.$clase.'><a href="?categoria='.$c['nombre'].'">'.$c['nombre'].'</a></li>';
                        }
                    }
?>                      
                    </ul>
                </div>
            </div>      
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?
                if (isset($_GET['categoria']) && !empty($_GET['categoria'])){
                    echo '<h2 class="subtitulo">'.$_GET['categoria'].'</h2>';
                }
                else{
                    $i = 0;
                    foreach($categorias as $c){
                        $hijos = $db->fetch_all("SELECT * FROM libreria WHERE categoria = {$c['id']} && activo = 1");
                        if (count($hijos) > 0){
                            $i++;
                            if($i == 1){
                                echo '<h2 class="subtitulo">'.$c['nombre'].'</h2>';
                            }

                        }
                    }
                }


?>
                </div>
            </div>
            <div class="row">

<?
            if (isset($_GET['categoria']) && !empty($_GET['categoria'])){
                $categoria_get = $_GET['categoria'];
                $categoria_actual = $db->fetch_item("SELECT * FROM categorias_libros WHERE nombre = '{$categoria_get}'");
            }
            else{
                $i = 0;                        
                foreach($categorias as $c){
                    $hijos = $db->fetch_all("SELECT * FROM libreria WHERE categoria = {$c['id']} && activo = 1");
                    if (count($hijos) > 0){
                        $i++;
                        if ($i == 1){
                            $categoria_actual = $db->fetch_item("SELECT * FROM categorias_libros WHERE nombre = '{$c['nombre']}'");
                        }
                    }
                }

            }
            $categoria_id = $categoria_actual['id'];

            $libros = $db->fetch_all('SELECT * FROM libreria WHERE activo = 1 ORDER BY id DESC');

            $i = 0; 
            
            foreach($libros as $l){
                if ($l['categoria'] == $categoria_id){
                   
?>                      
                   <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 libro">
                        <div class="container-libro">
                            <img src="uploads/<? echo $l['imagen']?>" alt="">
                            <p class="descripcion"><? echo $l['titulo']?></p>
                            <p class="datos"><b><? echo $l['autor']?></b>
                                <? echo $l['editorial']?></p>
                        </div>
                    </div>
<?
                    if ($i == 3){
?>
                        <div style="clear:both"></div>
<?
                    }
                    $i++;
                    $i = $i % 4;
                }
            }

?>                
                
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="contacto.php" class="btn btn-franquicias in-tablas">SU CONSULTA NOS INTERESA</a>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
