<?
	$dir="../uploads/galerias/".$content['id_galeria'];  //nombre de la carpeta
	$id=$_GET['id_content'];
	$content = $db->fetch_item("SELECT * FROM galerias_contenido WHERE id = {$id}");
	if($id>0){
		$targ_w = 300;
		$targ_h = 250;
?>
		<form class="form-horizontal" role="form" method="post" action="galerias.php?action=uploadContent&id_galeria=<?=$content['id_galeria']?>&id_content=<?=$id?>" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label">Titulo</label>
				<div class="col-sm-5">
					<input type="text" name="titulo" id="titulo" class="form-control" value="<?=$content['titulo']?>"><span class="badge"></span>
				</div>
			</div>		
		
			<div class="form-group">
				<label class="col-sm-2 control-label">Imagen</label>
				<div class="col-sm-10">
					<?if(!$content['url_youtube']){	?>
						<img src="<?=$dir."/".$content['archivo']?>" width="200" height="130" class="img-responsive" alt="..."><?'."\n" '?>
					<?}else{
						$pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
						$youtube_id = (preg_replace($pattern, '$1', $content['url_youtube']));
					?><iframe width="<?=$targ_w?>" height="<?=$targ_h?>" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe>
					<?}	?>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Cambiar imagen</label>
				<div class="col-sm-10">
					<input type="file" name="archivo" id="archivo">
					<input type="hidden" name="coords" id="coords" >
					<p class="help-block">Seleccione una imagen.</p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Video de Youtube</label>
				<div class="col-sm-5">
					<input type="text" name="url_youtube" id="url_youtube" class="form-control" value="<?=$content['url_youtube']?>"><span class="badge"></span>
					<p class="help-block">Inserte la URL de un video de Youtube (ej: http://www.youtube.com/watch?v=Hc7oa-e3Blg).</p>
				</div>
			</div>
			
			<div class="col-sm-12">
				<canvas></canvas>
			</div>
			
			<div class="form-group">
			<label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
				<a href="galerias.php?action=view&id_galeria=<?=$content['id_galeria']?>" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
				<button type="submit" name="editar_contenido" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Guardar</button>
				<input type="hidden" name="id" value="<?=$id?>" />
			</div>
			</div>
		</form>
	<? } ?>
	


