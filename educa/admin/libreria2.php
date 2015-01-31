<?
	include('inc/init.php');

	$action = $_REQUEST['action'];
	$id = intval($_REQUEST['id']);

	$upload_dir = '../uploads/';
	$targ_w = 160;
	$targ_h = 235;
	$img_quality = 96;
	
	switch($_SESSION['msg_code']){
		case 1:
			$mensajes[] = 'El libro fue <strong>actualizado</strong> con éxito';
		break;
		case 2:
			$mensajes[] = 'El libro fue <strong>añadido</strong> con éxito';
		break;
		case 3:
			$mensajes[] = 'El libro fue <strong>eliminado</strong> con éxito';
		break;
	}
	$_SESSION['msg_code'] = null;
	unset($_SESSION['msg_code']);

	if($id){
		$item = $db->fetch_item("SELECT * FROM libreria WHERE id=$id");
	}
    
	if($_POST['save']){

		$titulo = $db->escape_string($_POST['titulo']);
		$categoria = $db->escape_string($_POST['categoria']);
		$autor = $db->escape_string($_POST['autor']);
		$editorial = $db->escape_string($_POST['editorial']);
		$activo = ($_POST['activo']?1:0);
		$crop_data = json_decode($_POST['coords'],true);
		$posicion = 999;
		$archivo = $_FILES["archivo"];

		if(!$titulo || !$categoria)
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

			var_dump($crop_data);
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
				categoria = '{$id_categoria}',
				autor = '{$autor}',
				editorial = '{$editorial}',
				posicion = '{$posicion}',
				activo = '{$activo}'
			";

			if($filename){
				$fields.=",image = '{$filename}'";
			}

			if($item){
				if($filename && $item['image'] && $filename!=$item['image']){
					@unlink($upload_dir.$item['image']);
				}
				$db->update("UPDATE libreria SET {$fields} WHERE id = {$id}");
			} else {
				$insert = $db->insert("INSERT INTO libreria SET {$fields}");
			}
			if($_POST['apply']){
				redirect("libreria2.php?id={$id}");
			} else {
				redirect("libreria2.php");
			}

		}
	}

	if($_GET['action'] == 'delete'){

		if($item){
			@unlink($upload_dir.$item['image']);
			$db->delete("DELETE FROM libreria WHERE id={$item['id']}");

			if(!$db->error()){
				$_SESSION['msg_code'] = 3;
				redirect('libreria2.php');
			} else {
				$errores[] = $db->error();
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



<?              
				var_dump($_REQUEST);
				if($errores){
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
		                <a href="libreria2.php?action=new" class="btn btn-primary"><i class="fa fa-plus"></i>  Añadir Libro</a>
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
							    <th>Titulo</th>
                                <th class="center">Autor</td>
                                <th class="center">Editorial</td>
                                <td class="center"></td>
                                <td class="center"></td>
						    </tr>
                        </thead>
<?
                        $categorias = $db->fetch_all("SELECT * FROM categorias_libros");
                        foreach($categorias as $c){
                            $hijos = $db->fetch_all("SELECT * FROM libreria WHERE categoria = {$c['id']}");
                            if (count($hijos) > 0){
                                echo '<thead>
                                    <tr class="active">
                                        <th></th>
								        <th class="center">'.$c['nombre'].'</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
								    </tr>
                                </thead>';
                                foreach($hijos as $h){
                                    echo '<tr id="libreria_'.$h['id'].'">
                                        <td ><img src="'.$upload_dir.$h['imagen'].'" /></td>
								        <td width="50%">'.$h['titulo'].'</td>
                                        <td >'.$h['autor'].'</td>
                                        <td >'.$h['editorial'].'</td>
                                        <td class="hidden">'.$c['nombre'].'</td>
                                        <td class="center"><a href="libreria2.php?action=edit&id='.$h['id'].'" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a></td>
                                        <td class="center"><a href="libreria2.php?action=delete&id='.$h['id'].'" class="btn btn-danger" onClick="return confirm("¿Seguro que desea eliminar este libro?");"><span class="glyphicon glyphicon-trash"></span></a></td>
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
	</div>

	<script type="text/javascript">
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
