<?
include('inc/init.php');
@session_start();

$_SESSION['galeria_id']=$_GET['id_galeria'];

$action = $_GET['action'];
$targ_w = 472;
$targ_h = 251;
$img_quality = 95;

switch ($_GET['msg_code']) {
    case 1:
        $mensajes[] = 'La galería fue <strong>actualizada</strong> con éxito';
        break;
    case 2:
        $mensajes[] = 'La galería fue <strong>añadida</strong> con éxito';
        break;
    case 3:
        $mensajes[] = 'La galería fue <strong>eliminada</strong> con éxito';
        break;
    case 4:
        $mensajes[] = 'El contenido de la galería fue <strong>eliminado</strong> con éxito';
        break;
}

switch ($action) {
    case 'new':
        break;
	case 'uploadVideo':
		$idG = $_POST['idG'];
		$url_youtube = $db->escape_string($_POST['url_youtube']);
		if ($url_youtube){
			$fields = "
					url_youtube = '{$url_youtube}',
					id_galeria='{$idG}'
				";
			$insert = $db->insert("INSERT INTO galerias_contenido SET {$fields}");
		}	
		redirect("galerias.php?action=view&id_galeria={$idG}");
		break;
    case 'uploadContent':
        if (isset($_POST['subir_contenido']) || isset($_POST['editar_contenido'])) {
            $idG = $_GET['id_galeria'];
            $idC = $_GET['id_content'];
            $upload_dir = "../uploads/galerias/" . $idG . "/";  //nombre de la carpeta
            if ($idG) {
                $item = $db->fetch_item("SELECT * FROM galerias_contenido WHERE id = {$idC}");
            }
            $titulo = $db->escape_string($_POST['titulo']);
            $archivo = $_FILES["archivo"];
            $url_youtube = $db->escape_string($_POST['url_youtube']);
            $crop_data = json_decode($_POST['coords'], true);

            //if((!$_POST['url_youtube']) || (!$archivo['tmp_name'])){
            //	$errores[] = 'Error al recibir el archivo';
            //}
            if ($archivo['tmp_name']) {
                $allowedExts = array("mp4", "jpeg", "jpg", "png");
                $allowedMime = array("video/mp4", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png");
                $videos_types = array('video/mp4');
                $extension = end(explode(".", $archivo['name']));
                if (!in_array($archivo["type"], $videos_types)) {
                    $max_size = 5242880;

                    list($width_tmp, $height_tmp) = getimagesize($archivo['tmp_name']);

                    if ($archivo['size'] > $max_size) {
                        $errores[] = "El archivo es demasiado grande. El tama&ntilde;o m&aacute;ximo es de 5Mb.";
                    }
                    /* if($width_tmp > 900 || $height_tmp > 600){
                      $errores[] = "La imagen es demasiado grande. Debe medir como máximo 900 x 600";
                      } */
                    /* if($width_tmp < $targ_w || $height_tmp < $targ_h){
                      $errores[] = "La imagen en muy pequeña. Debe medir al menos {$targ_w}x{$targ_h}";
                      } */
                    $file_type = 'image';
                } else {
                    $file_type = 'video';
                }
                if (!in_array($archivo["type"], $allowedMime) || !in_array(strtolower($extension), $allowedExts)) {
                    $errores[] = "Archivo invalido";
                }
            }

            if (empty($errores)) {
                if ($archivo) {
                    if ($file_type == 'image') {
                        move_uploaded_file($_FILES['archivo']['tmp_name'], "./uploads/galerias/" . $id . "/");
                        $image = new Image($archivo["tmp_name"], $error);
                        if ($error) {
                            $errores[] = $error;
                        } else {
                            $filename = getUniqueFilename(basename($archivo['name'], ".{$extension}"), "." . strtolower($extension), $upload_dir);

                            $image->crop($crop_data['x'], $crop_data['y'], $crop_data['w'], $crop_data['h']);
                            $image->resize($targ_w, $targ_h, MODE_FIXED);
                            $image->save($upload_dir . $filename);
                        }
                    } elseif ($file_type == 'video') {
                        $filename = getUniqueFilename(basename($archivo['name'], ".{$extension}"), "." . strtolower($extension), $upload_dir);
                        move_uploaded_file($archivo['tmp_name'], $upload_dir . $filename);
                    } else {
                        $errores[] = "Archivo inv&aacute;lido";
                    }
                }

                $fields = "
					titulo = '{$titulo}',
					url_youtube = '{$url_youtube}',
					id_galeria='{$idG}'
				";

                if ($filename) {
                    $fields.=", archivo = '{$filename}'";
                }
                if (isset($_POST['editar_contenido'])) {
                    //esta editando
                    if ($filename) {
                        @unlink($upload_dir . $item['archivo']);
                    }
                    $db->update("UPDATE galerias_contenido SET {$fields} WHERE id = {$idC}");
                } else {
                    $db->insert("INSERT INTO galerias_contenido SET {$fields}");
                }
                if ($db->error())
                    die('c' . $idC);
                if ($_POST['apply']) {
                    redirect("galerias.php?id={$idG}");
                } else {
                    //redirect("galerias.php?list=".$_POST['list']);
                    redirect("galerias.php?action=view&id_galeria={$idG}");
                }
            }
        }
        break;

    case 'upload': 
        if (isset($_POST['subir_galeria'])) {

            $id = $db->escape_string($_POST['id']);
            if ($id) {
                $item = $db->fetch_item("SELECT * FROM galerias WHERE id = {$id}");
            }
            $nombre = $db->escape_string($_POST['nombre']);
            $categoria = $db->escape_string($_POST['categoria']);
            $crop_data = json_decode($_POST['coords'], true);
            $archivo = $_FILES["archivo"];

            if (!$nombre) {
                $errores[] = 'Debe escribir un nombre';
            }

            if (empty($errores)) {
                $fields = "
						nombre = '{$nombre}',
                        categoria = '{$categoria}'
					";

                if ($item) {
                    if ($filename) {
                        @unlink($upload_dir . $item['archivo']);
                    }
                    $db->update("UPDATE galerias SET {$fields} WHERE id = {$id}");
                } else {
                    $insert = $db->insert("INSERT INTO galerias SET {$fields}");
                    //creo carpeta para poner las imagenes de la galeria
                    $id = mysql_insert_id();
                    if(mkdir("../uploads/galerias/" . $id , 0755, true))
			    chmod("../uploads/galerias/" . $id , 0755);
                }
                if ($_POST['apply']) {
                    redirect("galerias.php?id={$id}");
                } else {
                    redirect("galerias.php?list=" . $_POST['list']);
                }
            }
        }
        break;


    case 'delete':
        $id_galeria = (int) $_GET['id_galeria'];
        if ($id_galeria > 0) {
            $db->delete("DELETE FROM galerias WHERE id = {$id_galeria}");
            $carpeta = "../uploads/galerias/" . $id_galeria;  //nombre de la carpeta
            
            if (!$db->error()){
                delTree($carpeta);
                redirect('galerias.php?msg_code=3');
            }
            else
                $errores[] = $db->error();
        }
        break;

    case 'deleteContent':
        $idG = $_GET['id_galeria'];
        $idC = $_GET['id_content'];
        $upload_dir = "../uploads/galerias/" . $idG . "/";  //nombre de la carpeta
        $img = $db->fetch_item("SELECT * FROM galerias_contenido WHERE id = {$idC}");
        if ($idC > 0) {
            $db->delete("DELETE FROM galerias_contenido WHERE id = {$idC}");
        }
        if (!unlink($upload_dir . $img['archivo'])) {
            $errores[] = 'No se pudo borrar la imagen';
        }
        if (!$db->error()) {
            $mensajes[] = 'El contenido fue eliminado con éxito';
            redirect("galerias.php?action=view&id_galeria={$idG}");
        }
        else
            $errores[] = $db->error();
        break;
}
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
    <head>
        <meta charset="<?= $charset ?>">
        <meta name="robots" content="noindex">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $nombre_sitio ?> - Panel de Administración</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilos.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        
        <script src="js/jquery.sieve.min.js"></script>
        <script src="../js/mediaelementjs/mediaelement-and-player.min.js"></script>
        <link rel="stylesheet" href="../js/mediaelementjs/mediaelementplayer.css" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="css/jquery.fileupload.css">
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>
        <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script type="text/javascript">
            $(document).bind("mobileinit", function() {
                $.extend($.mobile, {
                    ajaxEnabled: false,
                    defaultPageTransition: 'none'
                });
            });
        </script>
        <style>
        	li.galeria {
        		height: 360px;
        		margin-bottom: 20px;
        	}
        </style>
    </head>

    <body>
        <div class="container">
            <?php include("includes/layout/header.php"); ?>
            <div class="well box">
                <?php include("includes/layout/menu.php"); ?>
                <? include("includes/functions/alertas.php"); ?>
                <div class="contenido row">
                    <div class="col-sm-12">

                        <? if (is_array($errores)) { ?><div class="alert alert-error"><ul><li><?= implode('</li><li>', $errores) ?></li></ul></div><? } ?>
                        <? if (is_array($mensajes)) { ?><div class="alert alert-success"><ul><li><?= implode('</li><li>', $mensajes) ?></li></ul></div><? } ?>

                        <?
                        switch ($action) {
                            case 'new': // Si estamos agregando una nueva galeria mostramos el formulario
                                include 'templates/galerias_add.php';
                                break;

                            case 'edit': // Si estamos agregando una nueva galeria mostramos el formulario
                                $galeria = $db->fetch_item("SELECT * FROM galerias WHERE id = {$db->escape_string($_GET['id_galeria'])}");
                                include 'templates/galerias_edit.php';
                                break;

                            case 'editContent':
                                $content = $db->fetch_item("SELECT * FROM galerias_contenido WHERE id_galeria = {$db->escape_string($_GET['id_galeria'])}");
                                include 'templates/galerias_editContent.php';
                                break;

                            case 'view':
                                $galeria = $db->fetch_item("SELECT * FROM galerias WHERE id = {$db->escape_string($_GET['id_galeria'])}");
                                include 'templates/galerias_addContent.php';
                                break;

                            case 'upload':
                                if (!$errores)
                                    if ($subido)
                                        print '<div class="alert alert-success">La galeria fue subido con éxito.</div>';
                                break;

                            

                            default:
                                    $galerias0 = $db->fetch_all("SELECT * FROM galerias where categoria=0 order by orden, id Desc");
                                $galerias1 = $db->fetch_all("SELECT * FROM galerias where categoria=1 order by orden, id Desc");
                                $galerias2 = $db->fetch_all("SELECT * FROM galerias where categoria=2 order by orden, id Desc");
                                include 'templates/galerias_list.php';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php include("includes/layout/footer.php"); ?>
        </div>
        <? if (!$_POST["action"] == "password" && $_SESSION["panel"]["first"] == 1 || !$_POST["action"] == "password" && $_GET["action"] == "password") { ?>
            <div class="modal hide" id="firstTime">
                <form action="index.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3>Nueva contraseña</h3>
                    </div>
                    <div class="modal-body">
                        <? if ($_SESSION["panel"]["first"] == 1) { ?><p>Antes de comenzar a gestionar el contenido de tu web es necesario que selecciones una contraseña para tu cuenta. Esto hará que tu panel de administración sea más seguro.</p><? } else { ?><p>Completá el siguiente formulario para cambiar tu contraseña</p><? } ?>
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
 
		$(document).ready(function() {
	            $('#fileupload').fileupload({
    				url: 'server/php/',
			}).on('fileuploadsubmit', function (e, data) {
    			data.formData = data.context.find(':input').serializeArray();

		    });
			 $('.dropdown-toggle').dropdown();
		});
            function cambiar_filtro(value) {
                location.href = 'galerias.php?list=' + value;
            }

            $(".sortable").sortable({
                update: function(event, ui) {
                    var orden = $(this).sortable('toArray').toString();
                    console.log(orden);
                    $.get('order.php', {orden: orden, order_general: '1'});
                }
            }).disableSelection();

            (function($) {
                $.fn.extend({
                    limiter: function(limit, elem) {
                        $(this).on("keyup focus", function() {
                            setCount(this, elem);
                        });
                        function setCount(src, elem) {
                            var chars = src.value.length;
                            if (chars > limit) {
                                src.value = src.value.substr(0, limit);
                                chars = limit;
                            }
                            elem.html(limit - chars);
                        }
                        setCount($(this)[0], elem);
                    }
                });
            })(jQuery);
        </script>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
<input name="id" class="form-control" value="<?php echo $idG;?>" type="hidden">
<input name="id_galeria[]" class="form-control" value="<?php echo $idG;?>" type="hidden">
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}

    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Eliminar</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>

<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
    </body>
</html>
