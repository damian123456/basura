<?
	
	$idG=$_GET['id_galeria'];
	$idC=$_GET['id_content'];
	$dir="../uploads/galerias/".$idG;  //nombre de la carpeta

	if($idG>0){
		$targ_w = 300;
		$targ_h = 250;
?><!-- The file upload form used as target for the file upload widget -->
<h2>Contenido de Galeria: <?php echo $galeria["nombre"]; ?></h2>
    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
        
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Agregar archivos...</span>
                    <input type="file" name="files[]" multiple>
		    
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Comenzar a cargarlos</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar la carga</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Eliminar</span>
                </button>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    <br>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<h2>Videos</h2>

<form class="form-horizontal" role="form" method="post" action="galerias.php?action=uploadVideo" enctype="multipart/form-data">
	<div class="form-group">
				<label class="col-sm-2 control-label">Video de Youtube</label>
				<div class="col-sm-5">
					<input type="text" name="url_youtube" id="url_youtube" class="form-control" value="<?=$content['url_youtube'] ?>"><span class="badge"></span>
					<p class="help-block">Inserte la URL de un video de Youtube (ej: http://www.youtube.com/watch?v=Hc7oa-e3Blg).</p>
				</div>
				<div class="col-sm-5">
			 		<button type="submit" name="editar_contenido" class="btn-sm btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Agregar</button>
					<input type="hidden" name="idG" value="<?=$idG ?>" />
				</div>
	</div>
	
</form>		
<?php
//para mostrar los videos:
	$content = $db -> fetch_all("SELECT * FROM galerias_contenido WHERE id_galeria = {$idG} and url_youtube<>''");

/*	foreach ($content as $value) {
		$pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
		$youtube_id = (preg_replace($pattern, '$1', $value['url_youtube']));
		?><iframe width="<?=$targ_w?>" height="<?=$targ_h?>" src="http://www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe>
		<?php
	}*/
	echo "<ul>	<input type='hidden' name='idG' id='idG' value='".$idG."'/>";
	foreach ($content as $value) {
		echo "<li>";
		echo "<input type='hidden' name='id' value='".$value['id']."' />";
		echo $value['url_youtube'];?>

		
		<button type="button" class="btn btn-danger delete borrar_video">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span></span>
    	</button></li><br><?php
	}
	echo "</ul>";
?>	
<br><br>
<a href="galerias.php" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
	<? } ?>
	


