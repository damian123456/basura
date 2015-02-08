<?php
    /* NOTICIAS */

    /* BD:
        id
        titulo
        contenido
        orden
        imagen
        activo
        posicion
        added
        modified
    */

        /* CAMBIE
            libreria / noticias
            libro / noticia
            categorias / contenido*/

?>

<?
    include('inc/init.php');
    require_once("../includes/config.php");//agregue
    
    $action = $_REQUEST['action'];
    $id = intval($_REQUEST['id']);

    $upload_dir = '../uploads/';
    $targ_w = 186;
    $targ_h = 121;
    $img_quality = 96;

    switch($_GET['msg_code']){
        case 1:
            $mensajes[] = 'La noticia fue <strong>añadida</strong> con éxito';
        break;
        case 2:
            $mensajes[] = 'La noticia fue <strong>editada</strong> con éxito';
        break;
        case 3:
            $mensajes[] = 'La noticia fue <strong>eliminada</strong> con éxito';
        break;
    }

    if($id){
        $item = $db->fetch_item("SELECT * FROM noticias WHERE id=$id");
    }
    
    if($_POST['save']){

        $titulo = $db->escape_string($_POST['titulo']);
        $contenido = $db->escape_string($_POST['contenido']);
        $crop_data = json_decode(stripslashes($_POST['coords']),true);
        $activo = ($_POST['activo']?1:0);
        $posicion = 0;
        $archivo = $_FILES["archivo"];

        if(!$titulo || !$contenido)
            $errores[] = 'Todos los campos son obligatorios';

        if(!$archivo['tmp_name'] && !$item){
            $errores[] = 'Error al recibir el archivo';
        } elseif($archivo['tmp_name']) {
            $allowedExts = array("jpeg", "jpg", "png");
            $allowedMime = array("image/jpeg","image/jpg","image/pjpeg","image/x-png","image/png");
            $extension = end(explode(".", $archivo['name']));
            $max_size = 5242880;

            list($width_tmp, $height_tmp) = getimagesize($archivo['tmp_name']);

            if($archivo['size'] > $max_size){
                $errores[] = "El archivo es demasiado grande. El tama&ntilde;o m&aacute;ximo es de 5Mb.";
            }
            if($width_tmp < $targ_w || $height_tmp < $targ_h){
                $errores[] = "La imagen en muy pequeña. Debe medir al menos {$targ_w}x{$targ_h}";
            }
            if (!in_array($archivo["type"], $allowedMime) || !in_array(strtolower($extension), $allowedExts)){
                $errores[] = "Archivo invalido";
            }
        }

        if(empty($errores)){

            if($archivo){
                $image = new Image($archivo["tmp_name"],$error);
                if($error){
                    $errores[] = $error;
                } else {
                    $filename = getUniqueFilename(basename($archivo['name'],".{$extension}"),".".strtolower($extension),$upload_dir);

                    $image->crop($crop_data['x'],$crop_data['y'],$crop_data['w'],$crop_data['h']);
                    $image->resize($targ_w, $targ_h, MODE_FIXED);
                    $image->save($upload_dir.$filename);
                }
            }

            $fields = "
                titulo = '{$titulo}',
                contenido = '{$contenido}',
                posicion = '{$posicion}',
                activo = '{$activo}'
            ";
            
            if($filename){
                $fields.=",imagen = '{$filename}'";
            }
           
            if($item){
                if($filename && $item['imagen'] && $filename!=$item['imagen']){
                    @unlink($upload_dir.$item['imagen']);
                }
                $db->update("UPDATE noticias SET {$fields}, modified=NOW() WHERE id = {$id}");
            } else {
                $insert = $db->insert("INSERT INTO noticias SET {$fields}, added=NOW()");
            }
            if($_POST['apply']){
                redirect("noticias.php?id={$id}");
            } else {
                redirect("noticias.php");
            }

        }
    }
    
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


<?
            switch($action){
                case 'new': // Si estamos agregando un nuevo banner mostramos el formulario
                    include 'templates/noticias_add.php'; 
                    break;
                
                case 'edit': // Si estamos agregando un nuevo banner mostramos el formulario
                    $id_noticia = (int) $_GET['id'];
                    $noticia = $db->fetch_item("SELECT * FROM noticias WHERE id = {$id}");
                    include 'templates/noticias_add.php';
                    break; 


                case 'delete':
                    $id_noticia = (int) $_GET['id'];

                    if($id_noticia>0){
                        $db->delete("DELETE FROM noticias WHERE id = {$id_noticia}");

                        if(!$db->error())
                            redirect("noticias.php?msg_code=3");
                        else
                            $errores[] = $db->error();
                    }
                    break;

                default:
                    
                    $noticias = $db->fetch_all("
                        SELECT * 
                        FROM noticias 
                        ORDER BY posicion, id
                    ");
?>
                <div class="well row" style="margin-left:0;margin-right:0;background:#f0f0f0">
                    <div class="form-horizontal col-sm-6">
                        <label for="inputFilter" class="col-sm-2 control-label">Filtrar:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" id="inputFilter" placeholder="Filtrar...">
                        </div>
                    </div>
                    <div class="col-sm-6" style="text-align:right">
                        <a href="noticias.php?action=new" class="btn btn-primary"><i class="fa fa-plus"></i>  Añadir noticia</a>
                    </div>
                </div>
                <div class="separador">&nbsp;</div>
                
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("table").sieve({
                            searchInput: $('#inputFilter')
                        });
                    });
                </script>

<?              if($noticias){   ?>
                    <table id="sort" class="table table-striped">
                        <!-- On rows -->
                        <tbody>
<?                          foreach($noticias as $k => $noticia){   ?>
                            <tr id="noticia_<?=$noticia['id']?>">
                                <td class="hidden-xs"><img src="<?=$upload_dir.$noticia['imagen']?>" class="img-responsive" /></td>
                                <td width="80%"><?=$noticia['titulo']?><br/><small><?=$noticia['contenido']?></small></td>
                                <td class="center"><a href="noticias.php?action=edit&id=<?=$noticia['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a></td>
                                <td class="center"><a href="noticias.php?action=delete&id=<?=$noticia['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar esta noticia?');"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
<?                          }
                 ?>
                        </tbody>
                    </table>
<?              }else{   ?>
                <p class="text-center">No hay noticias.</p>
<?              }   ?>
<?          }   ?>
                </div>
            </div>
        </div>
        <?php include("includes/layout/footer.php"); ?>
    </div>
    <? if(!$_POST["action"]=="password"&&$_SESSION["panel"]["first"]==1||!$_POST["action"]=="password"&&$_GET["action"]=="password"){ ?>
    <div class="modal hide" id="firstTime">
    <form action="index.php" method="POST">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Nueva contraseña</h3>
    </div>
        <div class="modal-body">
            <? if($_SESSION["panel"]["first"]==1){ ?><p>Antes de comenzar a gestionar el contenido de tu web es necesario que selecciones una contraseña para tu cuenta. Esto hará que tu panel de administración sea más seguro.</p><? } else{ ?><p>Completá el siguiente formulario para cambiar tu contraseña</p><? } ?>
                <label>Escribí una contraseña:</label>
                <input autocomplete="off" type="password" name="password" id="password">
                <label>Repetí la contraseña:</label>
                <input autocomplete="off" type="password" name="passwordagain">
            </div>
            <div class="modal-footer">
            <input type="hidden" name="action" value="password">
            <button type="submit" class="btn btn-info">Guardar cambios</button>
            <a href="#" class="btn" data-dismiss="modal">Seleccionar más tarde</a>
        </div>
    </form>
    </div>
    <? } ?>
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
