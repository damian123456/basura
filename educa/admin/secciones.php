<?
    include('inc/init.php');
    require_once("../includes/config.php");//agregue
    $action = $_GET['action'];

    switch($_GET['msg_code']){
        case 1:
            $mensajes[] = 'La sección fue <strong>añadida</strong> con éxito';
        break;
        case 2:
            $mensajes[] = 'La sección fue <strong>editada</strong> con éxito';
        break;
        case 3:
            $mensajes[] = 'La sección fue <strong>eliminada</strong> con éxito';
        break;
    }

    switch($action){
        case 'add':
            $titulo = $db->escape_string($_POST['titulo']);

            if(isset($_POST['nueva_seccion'])){
                if($titulo){
                    $db->insert("INSERT INTO secciones SET nombre = '{$titulo}'");

                    if(!$db->error())
                        redirect("secciones.php?msg_code=1");
                    else
                        $errores[] = $db->error();
                }
            }
        break;

        case 'edit':
            $id_seccion = (int) $_GET['id'];
            $titulo = $db->escape_string($_POST['titulo']);

            if(isset($_POST['guardar_seccion'])&&$id_seccion>0){
                if($titulo){
                    $db->update("UPDATE secciones SET nombre = '{$titulo}' WHERE id = {$id_seccion}");

                    if(!$db->error())
                        redirect("secciones.php?msg_code=2");
                    else
                        $errores[] = $db->error();
                }
            }
        break;

        case 'delete':
            $id_seccion = (int) $_GET['id'];

            if($id_seccion>0){
                $db->delete("DELETE FROM secciones WHERE id = {$id_seccion}");

                if(!$db->error())
                    redirect("secciones.php?msg_code=3");
                else
                    $errores[] = $db->error();
            }
        break;
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
    <script src="http://code.jquery.com/mobile/1.4.0-alpha.2/jquery.mobile-1.4.0-alpha.2.min.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>
		<script src="js/jquery.sieve.min.js"></script>
</head>

<body>
    <div class="container">
    	<?php include("includes/layout/header.php"); ?>
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
?>
                <form class="form-horizontal" role="form" method="post" action="secciones.php?action=add" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Titulo</label>
                    <div class="col-sm-5">
                      <input type="text" name="titulo" class="form-control" placeholder="Titulo de la sección" required>
                    </div>
                    <div class="col-sm-5">
                      <button type="submit" name="nueva_seccion" class="btn btn-primary">Crear</button>
                    </div>
                  </div>
                </form>
<?
                break;
                case 'edit': // Si estamos agregando un nuevo banner mostramos el formulario
                $id_seccion = (int) $_GET['id'];
                $seccion = $db->fetch_item("SELECT * FROM secciones WHERE id = {$id_seccion}");
?>
                <form class="form-horizontal" role="form" method="post" action="secciones.php?action=edit&id=<?=$seccion['id']?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Titulo</label>
                    <div class="col-sm-3">
                      <input type="text" name="titulo" value="<?=$seccion['nombre']?>" class="form-control" placeholder="Titulo de la sección" required>
                    </div>
                    <div class="col-sm-7">
                      <button type="submit" name="guardar_seccion" class="btn btn-success">Guardar</button>
                    </div>
                  </div>
                </form>
<?
                break;

                default:

                $secciones = $db->fetch_all("SELECT * FROM secciones ORDER BY orden ASC");
?>
                <div class="center">
                    <a href="secciones.php?action=new" class="btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Nueva sección</a>
                </div>
                <div class="separador">&nbsp;</div>
<?              if($secciones){   ?>
                    <table id="sort" class="table table-striped">
                        <!-- On rows -->
                        <thead>
                            <tr class="active">
                                <th>Nombre</th>
                                <th class="center">Editar</th>
                                <th class="center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
<?                          foreach($secciones as $k => $seccion){   ?>
                            <tr id="seccion_<?=$seccion['id']?>">
                                <td width="80%"><?=$seccion['nombre']?></td>
                                <td class="center"><a href="secciones.php?action=edit&id=<?=$seccion['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a></td>
                                <td class="center"><a href="secciones.php?action=delete&id=<?=$seccion['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar esta sección?');"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
<?                          }   ?>
                        </tbody>
                    </table>
<?              }else{   ?>
				<p class="text-center">No hay secciones.</p>
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
    function setCoords(c){
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }

    function checkCoords(){
        if (parseInt($('#w').val())) return true;
        alert('Por favor, seleccione un área en la imagen para recortar antes de presionar el boton "cortar".');
        return false;
    };

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
