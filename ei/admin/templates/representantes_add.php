<form class="form-horizontal" role="form" method="post" action="representantes.php?action=add">
	<div class="form-group">
		<label class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="nombre" required />
		</div>
	</div>
<?	if($pais){   ?>
	<div class="form-group">
	<label class="col-sm-2 control-label">País</label>
	<div class="col-sm-10">
		<select class="form-control" name="id_pais" onchange="actualizarMapa();" id="pais">
<?		foreach($pais as $p){	?>
			<option value="<?=$p['id']?>" data-name="<?=$p['Name']?>" <?=($representante['id_pais']==$p['id']?'selected="selected"':'')?>><?=$p['Name']?></option>
<?	  } ?>
		</select>
	</div>
	</div>
<?	} ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Provincia</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="provincia" onkeyup="actualizarMapa();" id="provincia" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Ciudad</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="ciudad" onkeyup="actualizarMapa();" id="ciudad" required />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Dirección</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="direccion" onkeyup="actualizarMapa();" id="direccion" required />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Teléfono</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="telefono" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="email" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Activo</label>
		<span class="col-sm-10">
			<input type="checkbox" name="activo">
		</span>
	</div>
	<div class="form-group">
		<div class="col-sm-2">&nbsp;</div>
		<div class="col-sm-10">
			<div id="map-canvas" style="height:300px"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10">
			<a href="representantes.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
			<button type="submit" name="agregar_representante" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Guardar</button>
			<input type="hidden" name="coordenadas_gmap" id="coordenadas_gmap" value="" />
		</div>
	</div>
</form>
