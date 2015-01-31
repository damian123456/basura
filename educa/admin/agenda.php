<?php
	/* NOSOTROS */
	/* AGENDA */
	/* COPIA DE LIBRERIA.PHP, REMPLACE: libreria | agenda , libro | evento , nombre | titulo */
?>

<?
    include('inc/init.php');
    require_once("../includes/config.php");//agregue
    $action = $_GET['action'];
    setlocale(LC_ALL,"es_ES");

    switch($_GET['msg_code']){
        case 1:
            $mensajes[] = 'El evento fue <strong>añadido</strong> con éxito';
        break;
        case 2:
            $mensajes[] = 'El evento fue <strong>editado</strong> con éxito';
        break;
        case 3:
            $mensajes[] = 'El evento fue <strong>eliminado</strong> con éxito';
        break;
    }

    switch($action){
        case 'add':
            $titulo = $db->escape_string($_POST['titulo']);
			$inicio = $db->escape_string(stripslashes($_POST['inicio']));
			$final = $db->escape_string(stripslashes($_POST['final']));
            $descripcion = $db->escape_string(stripslashes($_POST['descripcion']));
			
			$fields = "
				titulo = '{$titulo}',
				inicio = '{$inicio}',
				final = '{$final}',
				descripcion = '{$descripcion}'
			";

            if(isset($_POST['nuevo_evento'])){
                if($titulo){
                    $db->insert("INSERT INTO agenda SET {$fields}");

                    if(!$db->error())
                        redirect("agenda.php?msg_code=1");
                    else
                        $errores[] = $db->error();
                }
            }
        break;

        case 'edit':
            $id_evento = (int) $_GET['id'];
            $titulo = $db->escape_string($_POST['titulo']);

            if(isset($_POST['guardar_evento'])&&$id_evento>0){
                $titulo = $db->escape_string($_POST['titulo']);
			    $inicio = $db->escape_string(stripslashes($_POST['inicio']));
			    $final = $db->escape_string(stripslashes($_POST['final']));
                $descripcion = $db->escape_string(stripslashes($_POST['descripcion']));
			
			
                $fields = "
				titulo = '{$titulo}',
				inicio = '{$inicio}',
				final = '{$final}',
				descripcion = '{$descripcion}'
			";
                if($titulo){
                    $db->update("UPDATE agenda SET {$fields} WHERE id = {$id_evento}");

                    if(!$db->error())
                        redirect("agenda.php?msg_code=2");
                    else
                        $errores[] = $db->error();
                }
            }
        break;

        case 'delete':
            $id_evento = (int) $_GET['id'];

            if($id_evento>0){
                $db->delete("DELETE FROM agenda WHERE id = {$id_evento}");

                if(!$db->error())
                    redirect("agenda.php?msg_code=3");
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
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css" />
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
            <?php include("includes/layout/menu.php");  ?>
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

                <form class="form-horizontal" role="form" method="post" action="agenda.php?action=add" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Título</label>
                        <div class="input-group col-sm-5">
                            <input type="text" name="titulo" class="form-control" placeholder="Titulo del evento" required>
                        </div>
                    </div> 
                    <!--fecha-->  
                    <div class="form-group">    
                        <label class="col-sm-2 control-label">Fecha de inicio</label>
                        <div class="input-group date form_datetime col-md-5" data-date-format="yyyy-m-d H:i:00" data-link-field="dtp_input1">
                            <input name="inicio" class="form-control" size="16" type="text" value="" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>

                    <div class="form-group">    
                        <label class="col-sm-2 control-label">Fecha de finalizacion</label>
                        <div class="input-group date form_datetime col-md-5" data-date-format="yyyy-m-d H:i:00" data-link-field="dtp_input1">
                            <input name="final" class="form-control" size="16" type="text" value="" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>
                    <!--/fecha-->
					
                    <div class="form-group">    
                        <label class="col-sm-2 control-label">Descripcion</label>
                        <div class="input-group col-md-5">
				         <textarea style="height:200px;" type="text" name="descripcion" class="form-control" placeholder="Contenido" required></textarea>
                        </div>
                    </div>
					
                    <div class="col-sm-5">
                      <button type="submit" name="nuevo_evento" class="btn btn-primary">Crear</button>
                    </div>
                  
                </form>
<?
                break;
                case 'edit': // Si estamos agregando un nuevo banner mostramos el formulario
                $id_evento = (int) $_GET['id'];
                $evento = $db->fetch_item("SELECT * FROM agenda WHERE id = {$id_evento}");
?>
                <form class="form-horizontal" role="form" method="post" action="agenda.php?action=edit&id=<?=$id_evento?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Título</label>
                        <div class="input-group col-sm-5">
                            <input type="text" value="<?=$evento['titulo']?>" name="titulo" class="form-control" placeholder="Titulo del evento" required>
                        </div>
                    </div> 
                    <!--fecha-->  
                    <div class="form-group">    
                        <label class="col-sm-2 control-label">Fecha de inicio</label>
                        <div id="inicio" class="input-group date form_datetime col-md-5" data-date-format="yyyy-m-d H:i:00" data-link-field="dtp_input1">
                            <input name="inicio" class="form-control" size="16" type="text" value="<?=$evento['inicio']?>" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>

                    <div class="form-group">    
                        <label class="col-sm-2 control-label">Fecha de finalizacion</label>
                        <div class="input-group date form_datetime col-md-5" data-date-format="yyyy-m-d H:i:00" data-link-field="dtp_input1">
                            <input id="final" name="final" class="form-control" size="16" type="text" value="<?=$evento['final']?>" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>
                    <!--/fecha-->
					
                    <div class="form-group">    
                        <label class="col-sm-2 control-label">Descripcion</label>
                        <div class="input-group col-md-5">
				         <textarea style="height:200px;" type="text" name="descripcion" class="form-control" placeholder="Contenido" required><?=$evento['descripcion']?></textarea>
                        </div>
                    </div>
					
                    <div class="col-sm-5">
                        <input type="hidden" id="guardar_evento" name="guardar_evento" value="1" >
                      <button type="submit" name="nuevo_evento" class="btn btn-primary">Guardar</button>
                    </div>
                  
                </form>
<?
                break;

                default:
                
                $agenda = $db->fetch_all("SELECT * FROM agenda ORDER BY inicio");
?>
                <div class="center">
                    <a href="agenda.php?action=new" class="btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo evento</a>
                </div>
                <div class="separador">&nbsp;</div>
<?              if($agenda){   ?>
                    <table id="sort" class="table table-striped">
                        <!-- On rows -->
                        <thead>
                            <tr class="active">
                                <th>Titulo</th>
                                <th width="15%" class="center">Inicio</th>
                                <th width="15%" class="center">Final</th>
                                <th class="center">Ir</th>
                                <th class="center">Editar</th>
                                <th class="center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
<?                        
                            foreach($agenda as $k => $evento){
                            
                                $fecha_arreglo = date_parse($evento['inicio']);
                                $fecha_final = date_parse($evento['final']);

                                if ($fecha_arreglo['minute'] < 10){
                                    $fecha_arreglo['minute'] = '0'.$fecha_arreglo['minute'];
                                }
                                if ($fecha_final['minute'] < 10){
                                    $fecha_final['minute'] = '0'.$fecha_final['minute'];
                                }
?>                            
                            
                                <tr id="seccion_<?=$evento['id']?>">
                                    <th width="50%"><?=$evento['titulo']?></th>
                                    <td class="center">
                                        <?=$fecha_arreglo['day']?>/<?=$fecha_arreglo['month']?>/<?=$fecha_arreglo['year']?>
                                        <br>
                                        <?=$fecha_arreglo['hour'] ?>:<?=$fecha_arreglo['minute'] ?>
                                    </td>
                                    <td class="center">
                                        <?=$fecha_final['day']?>/<?=$fecha_final['month']?>/<?=$fecha_final['year']?>
                                        <br>
                                        <?=$fecha_final['hour'] ?>:<?=$fecha_final['minute'] ?>
                                    </td>
                                    <td class="center"><a href="../agenda.php?m=<?=$fecha_arreglo['month']?>&y=<?=$fecha_arreglo['year']?>" target="_blank" class="btn btn-primary"><span class="fa fa-globe"></span></a></td>
                                    <td class="center"><a href="agenda.php?action=edit&id=<?=$evento['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a></td>
                                    <td class="center"><a href="agenda.php?action=delete&id=<?=$evento['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar este evento?');"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
<?                          }   ?>
                        </tbody>
                    </table>
<?              }else{   ?>
				<p class="text-center">No hay eventos.</p>
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

    $('#inicio').change(function(){

        $('#final').attr('value') = $('#inicio').attr('value');
    })

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
    <script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
                    <script type="text/javascript" src="js/bootstrap.min.js"></script>
                    <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
                    <script type="text/javascript" src="js/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
                    <script type="text/javascript">
                        $('.form_datetime').datetimepicker({
                            language:  'es',
                            autoclose: 1,
                            todayHighlight: 1,
		                    defaultDate: '<?=date("m/d/Y")?>',
		                    minDate: '<?=date("m/d/Y")?>'
		                });
                    </script>
</body>

</html>

<?php

	/* FIN COPIA DE LIBRERIA.PHP, REMPLACE: libreria | agenda , libro | evento , nombre | titulo */
	/* FIN AGENDA */
	/* FIN NOSOTROS */
	
?>
