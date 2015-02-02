<?php
	/* NOSOTROS */
	/* LIBRERIA */
	/* COPIA DE NOTICIAS.PHP, REMPLACE: noticias | libreria , noticia | libro , titulo | nombre */
?>

<?
    include('inc/init.php');
    require_once("../includes/config.php");//agregue
    
    $action = $_REQUEST['action'];
	$id = intval($_REQUEST['id']);

	$upload_dir = '../uploads/';
	$targ_w = 160;
	$targ_h = 235;
	$img_quality = 96;

	switch($_GET['msg_code']){
        case 1:
            $mensajes[] = 'El libro fue <strong>añadido</strong> con éxito';
        break;
        case 2:
            $mensajes[] = 'El libro fue <strong>editado</strong> con éxito';
        break;
        case 3:
            $mensajes[] = 'El libro fue <strong>eliminado</strong> con éxito';
        break;
    }

    if($id){
		$item = $db->fetch_item("SELECT * FROM libreria WHERE id=$id");
	}
    
    if($_POST['save']){

		$titulo = $db->escape_string($_POST['titulo']);
		$categoria = $db->escape_string($_POST['categoria']);
		$autor = $db->escape_string($_POST['autor']);
		$editorial = $db->escape_string($_POST['editorial']);
		$crop_data = json_decode($_POST['coords'],true);
		$activo = ($_POST['activo']?1:0);
		$posicion = 0;
		$archivo = $_FILES["archivo"];

		if(!$titulo || !$categoria)
			$errores[] = 'El titulo y la categoria son obligatorios';

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
            //aldoaldo

            $categoriaLibro = $db->fetch_all("SELECT * FROM categorias_libros WHERE nombre= '{$categoria}'");
            
            if (count($categoriaLibro) != 0){
                $cate = $db->fetch_item("SELECT * FROM categorias_libros WHERE nombre = '{$categoria}'");
                $id_categoria = $cate['id'];
                $db->update("UPDATE categorias_libros SET modificado = now() WHERE nombre = '{$categoria}'");
            }
            else{
                $db->insert("INSERT INTO categorias_libros SET nombre = '{$categoria}' ");
                $id_categoria = mysql_insert_id();
            }
            




            //

			$fields = "
				titulo = '{$titulo}',
				categoria = '{$id_categoria}',
				autor = '{$autor}',
				editorial = '{$editorial}',
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
				$db->update("UPDATE libreria SET {$fields} WHERE id = {$id}");
			} else {
				$insert = $db->insert("INSERT INTO libreria SET {$fields}");
			}
			if($_POST['apply']){
				redirect("libreria.php?id={$id}");
			} else {
				redirect("libreria.php");
			}

		}
	}
    switch($action){
        case 'add':
            $nombre = $db->escape_string($_POST['nombre']);

            if(isset($_POST['nuevo_libro'])){
                if($nombre){
                    $db->insert("INSERT INTO libreria SET nombre = '{$nombre}'");

                    if(!$db->error())
                        redirect("libreria.php?msg_code=1");
                    else
                        $errores[] = $db->error();
                }
            }
        break;

        case 'edit':
            $id_libro = (int) $_GET['id'];
            $nombre = $db->escape_string($_POST['nombre']);

            if(isset($_POST['guardar_libro'])&&$id_libro>0){
                if($nombre){
                    $db->update("UPDATE libreria SET nombre = '{$nombre}' WHERE id = {$id_libro}");

                    if(!$db->error())
                        redirect("libreria.php?msg_code=2");
                    else
                        $errores[] = $db->error();
                }
            }
        break;

        case 'delete':
            $id_libro = (int) $_GET['id'];

            if($id_libro>0){
                $db->delete("DELETE FROM libreria WHERE id = {$id_libro}");

                if(!$db->error())
                    redirect("libreria.php?msg_code=3");
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
    <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/jquery.Jcrop.min.js"></script>
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
        <? include("includes/layout/header.php"); ?>
        <div class="well box">
            <? include("includes/layout/menu.php"); ?>
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
					include 'templates/libreria_add.php'; 
					break;
                
				case 'edit': // Si estamos agregando un nuevo banner mostramos el formulario
					$id_libro = (int) $_GET['id'];
					$libro = $db->fetch_item("SELECT * FROM libreria WHERE id = {$id_libro}");
					include 'templates/libreria_add.php';
					break; 

                default:
					
					$libreria = $db->fetch_all("
						SELECT * 
						FROM libreria 
						ORDER BY id DESC
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
		                <a href="libreria.php?action=new" class="btn btn-primary"><i class="fa fa-plus"></i>  Añadir Libro</a>
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

<?              if($libreria){   ?>
                    <table id="sort" class="table table-striped">
                        <!-- On rows -->
                        <thead>
                            <tr class="active">
                                <th></th>
							    <th>Titulo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Categoria</th>
                                <th class="center">Autor</td>
                                <th class="center">Editorial</td>
                                <th class="center">Ir</td>
                                <th class="center">Editar</td>
                                <th class="center">Eliminar</td>
						    </tr>
                        </thead>
<?
                        $categorias = $db->fetch_all("SELECT * FROM categorias_libros ORDER BY modificado DESC" );
                        foreach($categorias as $c){
                            $hijos = $db->fetch_all("SELECT * FROM libreria WHERE categoria = {$c['id']} ORDER BY id DESC");
                            if (count($hijos) > 0){
                                echo '<thead>
                                    <tr class="active">
                                        <th></th>
								        <th class="center">'.$c['nombre'].'</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
								    </tr>
                                </thead>';
                                foreach($hijos as $h){
                                    echo '<tr id="libreria_'.$h['id'].'">
                                        <td ><img src="'.$upload_dir.$h['imagen'].'" /></td>
								        <td width="40%">'.$h['titulo'].'</td>
                                        <td class="center" width= "20%">'.$h['autor'].'</td>
                                        <td class="center" width="20%">'.$h['editorial'].'</td>
                                        <td class="hidden">'.$c['nombre'].'</td>
                                        <td class="center"><a href="../libreria.php?categoria='.$c['nombre'].'" target="_blank" class="btn btn-primary"><span class="fa fa-globe"></span></a></td>
                                        <td class="center"><a href="libreria.php?action=edit&id='.$h['id'].'" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a></td>
                                        <td class="center"><a href="libreria.php?action=delete&id='.$h['id'].'" class="btn btn-danger" onClick="return confirm("¿Seguro que desea eliminar este libro?");"><span class="glyphicon glyphicon-trash"></span></a></td>
                                    </tr>';
                                }
                            }
                        }
?>
                    </table>


<?              }else{   ?>
				<p class="text-center">No hay libros.</p>
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
