<form class="form-horizontal" role="form" method="post" action="testimonios.php?action=add" enctype="multipart/form-data">
<?if($categorias){   ?>
	<div class="form-group" style="display:none">
		<label class="col-sm-2 control-label">Categoría</label>
		<div class="col-sm-10">
			<select class="form-control" name="id_categoria">
<?	foreach($categorias as $c){	?>
				<option value="<?=$c['id']?>" <?=($c['id']==$testimonio['id_categoria']?'selected="selected"':'')?>><?=$c['nombre']?></option>
<?		$subcategorias = $db->fetch_all("SELECT * FROM categorias WHERE parent = '{$c['id']}'");
		if($subcategorias) foreach($subcategorias as $sc){  ?>
				<option value="<?=$sc['id']?>" <?=($sc['id']==$testimonio['id_categoria']?'selected="selected"':'')?>>--- <?=$sc['nombre']?></option>
<?		} ?>
<?	} ?>
			</select>
		</div>
	</div>
<?} ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Foto de perfil</label>
		<div class="col-sm-10">
			<? if($testimonio['archivo']){ ?>
			<img src="../uploads/<?=$testimonio['archivo']?>">
			<? } else { ?>
			<img src="<?=url('img/about-testimonial-default.jpg')?>">
			<? } ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Cambiar foto</label>
		<div class="col-sm-10">
			<input type="file" name="archivo" id="archivo">
			<input type="hidden" name="coords" id="coords" >
			<p class="help-block">Seleccione una imagen.</p>
		</div>
	</div>
	 <div class="form-group">
		<label class="col-sm-2 control-label">Texto</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="6" name="texto"><?=$testimonio['texto']?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Activo</label>
		<span class="col-sm-10">
			<input type="checkbox" name="activo" <?=($testimonio['online']?'checked="checked"':'')?>>
		</span>
	</div>
	<div class="form-group"><div class="col-sm-10"><canvas></canvas></div></div>
	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10">
			<a href="testimonios.php?action=new" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
			<button type="submit" name="agregar_testimonio" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Guardar</button>
			<input type="hidden" name="id" value="<?=$testimonio['id']?>" />
		</div>
	</div>
</form>
