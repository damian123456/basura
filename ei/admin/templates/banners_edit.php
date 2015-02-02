<?
	if($banner['id_categoria']>0){
		$targ_w = 300;
		$targ_h = 250;
		$categorias = $db->fetch_all("SELECT * FROM categorias WHERE parent = 0");
?>
		<form class="form-horizontal" role="form" method="post" action="banners.php?action=upload&type=category" enctype="multipart/form-data">
			<div class="form-group">
			<label class="col-sm-2 control-label">Publicar</label>
			<div class="col-sm-10">
				<input type="checkbox" name="activo" id="activo" class="form-control" <?=$banner['activo']?'checked':''?> style="width:34px;height:34px;"></span>
			</div>
			</div>
<?          if($categorias){   ?>
			<div class="form-group">
			<label class="col-sm-2 control-label">Categoría</label>
			<div class="col-sm-10">
				<select class="form-control" name="id_categoria">
<?              foreach($categorias as $c){    ?>
					<option value="<?=$c['id']?>" <?=($c['id']==$banner['id_categoria']?'selected="selected"':'')?>><?=$c['nombre']?></option>
<?                  $subcategorias = $db->fetch_all("SELECT * FROM categorias WHERE parent = '{$c['id']}'");
				if($subcategorias)
					foreach($subcategorias as $sc){  ?>
					<option value="<?=$sc['id']?>" <?=($sc['id']==$banner['id_categoria']?'selected="selected"':'')?>>--- <?=$sc['nombre']?></option>
<?              	} ?>
<?      		} ?>
				</select>
			</div>
			</div>
<?	                } ?>
			<div class="form-group">
			<label class="col-sm-2 control-label">Video de Youtube</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="url_youtube" id="url_youtube" value="<?=$banner['url_youtube']?>">
				<p class="help-block">Inserte la URL de un video de Youtube (ej: http://www.youtube.com/watch?v=Hc7oa-e3Blg).</p>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Imagen</label>
			<div class="col-sm-10">
<?			if(substr($banner['archivo'],-4)!='.mp4'){ ?>
				<img src="<?=foto_url($banner['archivo'], $targ_w, $targ_h)?>" class="img-responsive" />
<?			} else { ?>
				<video id="videoPlayer" src="<?=$upload_dir.$banner['archivo']?>" width="<?=$targ_w?>" height="<?=$targ_h?>"></video>
<?			} ?>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Cambiar imagen o video</label>
			<div class="col-sm-10">
				<input type="file" name="archivo" id="archivo">
				<input type="hidden" name="coords" id="coords" >
					<p class="help-block">Seleccione una imagen.</p>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">URL</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="url" placeholder="http://" value="<?=$banner['url']?>" required>
				<p class="help-block">La dirección web a la que irá el visitante al hacer click en el banner</p>
			</div>
			</div>
			<div class="col-sm-12">
			<canvas></canvas>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
				<a href="banners.php" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
				<button type="submit" name="subir_banner_category" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Subir</button>
				<input type="hidden" name="id" value="<?=(int)$_GET['id_banner']?>" />
				<input type="hidden" name="list" value="categoria" />
			</div>
			</div>
		</form>
<?
		}else{
		$secciones = $db->fetch_all("SELECT * FROM secciones");
?>
		<div class="col-sm-12">
			<form class="form-horizontal" role="form" method="post" action="banners.php?action=upload" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label">Publicar</label>
				<div class="col-sm-10">
					<input type="checkbox" name="activo" id="activo" <?=$banner['activo']?'checked':''?> style="width:34px;height:34px;">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Titulo</label>
				<div class="col-sm-5">
					<input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo del banner" value="<?=$banner['titulo']?>" required> <span class="badge" id="titulo_count"></span>
				</div>
				<div class="hidden-sm hidden-md hidden-lg">&nbsp;</div>
				<div class="col-sm-5">
					<input type="text" name="titulo_2" class="form-control" id="titulo_2" placeholder="Titulo Segundo color" value="<?=$banner['titulo_2']?>"> <span class="badge" id="titulo_2_count"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Detalles</label>
				<div class="col-sm-10">
					<input type="text" name="detalles" id="detalles" class="form-control" placeholder="Detalles (opcional)" value="<?=$banner['detalles']?>" /> <span class="badge" id="detalles_count"></span>
				</div>
			</div>
<?           if($secciones){   ?>
			 <div class="form-group">
				<label class="col-sm-2 control-label">Ubicación</label>
				<div class="col-sm-10">
				 <select class="form-control" name="ubicacion">
<?                         foreach($secciones as $s){    ?>
				 <option value="<?=$s['id']?>" <?=($banner['id_seccion']==$s['id']?'selected':'')?>><?=$s['nombre']?></option>
<?                         } ?>
				 </select>
				</div>
			</div>
<?                   } ?>
			<div class="form-group">
			<label class="col-sm-2 control-label">Video de Youtube</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="url_youtube" id="url_youtube" value="<?=$banner['url_youtube']?>">
				<p class="help-block">Inserte la URL de un video de Youtube (ej: http://www.youtube.com/watch?v=Hc7oa-e3Blg).</p>
			</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Imagen</label>
				<div class="col-sm-10">
<?			if(!$banner['url_youtube']){	?>
				<img src="<?=foto_url($banner['archivo'],$targ_w,$targ_h)?>" class="img-responsive" alt="<?=$banner['titulo']?> <?=$banner['titulo_2']?>">
<?			}else{
				$pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
				$youtube_id = (preg_replace($pattern, '$1', $banner['url_youtube']));
?>
				<iframe width="<?=$targ_w?>" height="<?=$targ_h?>" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe>
<?			}	?>
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
				<label class="col-sm-2 control-label">URL</label>
				<div class="col-sm-10">
				<input type="text" class="form-control" name="url" placeholder="http://" value="<?=$banner['url']?>" required>
				<p class="help-block">La dirección web a la que irá el visitante al hacer click en el banner</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Texto del botón</label>
				<div class="col-sm-3">
				<input type="text" class="form-control" name="texto_boton" value="<?=$banner['texto_boton']?>" placeholder="Texto del botón">
				</div>
			</div>
			<div class="col-sm-12">
				<canvas></canvas>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">&nbsp;</label>
				<div class="col-sm-10">
				<a href="banners.php" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
				<button type="submit" name="subir_banner" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Guardar</button>
				<input type="hidden" name="id" value="<?=$banner['id']?>" />
				</div>
			</div>
			</form>
		</div>
<?
	}
?>
<script type="text/javascript">
	$('video').mediaelementplayer();
</script>
