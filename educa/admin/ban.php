
<?
    include('inc/init.php');
    require_once("../includes/config.php");//agregue
    
    ?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
    <meta charset="<?=$charset?>">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$nombre_sitio?> - Panel de Administración</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
    <script type="text/javascript">
        $(document).bind("mobileinit", function(){
            $.extend(  $.mobile , {
                ajaxEnabled: false,
                defaultPageTransition: 'none'
            });
        });
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.Jcrop.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.0-alpha.2/jquery.mobile-1.4.0-alpha.2.min.js"></script>
        <script src="js/jquery.ui.touch-punch.min.js"></script>
        <script src="js/jquery.sieve.min.js"></script>

</head>

<body>
    <div class="container">
        <?php include("includes/layout/header.php");?>
        
         <div class="well box">
            <?php include("includes/layout/menu.php"); ?>
            <? include("includes/functions/alertas.php"); ?>
            <div class="contenido row">
               <? include("templates/ban_add.php");?>

                <div class="col-sm-12">
<?              if($errores){
                    print '<div class="alert alert-error">';
                    print '<ul>';
                    foreach($errores as $k => $e){
                        print '<li>'.$e.'</li>';
                    }
                    print '</ul>';
                    print '</div>';
                }
?>
<?              if($mensajes){
                    print '<div class="alert alert-success">';
                    print '<ul>';
                    foreach($mensajes as $k => $e){
                        print '<li>'.$e.'</li>';
                    }
                    print '</ul>';
                    print '</div>';
                }
                

?>

                </div>
            </div>
        </div>
        <?php include("includes/layout/footer.php"); ?>
    </div>
    <? if(!$_POST["action"]=="password"&&$_SESSION["panel"]["first"]==1||!$_POST["action"]=="password"&&$_GET["action"]=="password"){ 


     } ?>
    <script>
    $(document).ready(function(){
        $(".alert").alert();
        $('.dropdown-toggle').dropdown();

        // Return a helper with preserved width of cells
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };

        $("#sort tbody").sortable({
            helper: fixHelper,
            update: function(event, ui) {
                var orden = $(this).sortable('toArray').toString();
                $.get('order.php', {orden:orden, order_general:'1'});
            }
        }).disableSelection();

        var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index)
            {
              $(this).width($originals.eq(index).width())
            });
            return $helper;
        };
    });
    </script>
</body>
</html>

<?php

    /* FIN COPIA DE NOTICIAS.PHP, REMPLACE: noticias | libreria , noticia | libro , titulo | nombre */
    /* FIN LIBRERIA */
    /* FIN NOSOTROS */
    
?>
