<?
	$categorias = $db->fetch_all("SELECT * FROM categorias WHERE parent = 0");
?>
	<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" action="clientes.php?action=upload" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-sm-2 control-label">Publicar</label>
			<div class="col-sm-10">
				<input type="checkbox" name="activo" id="activo" <?=$cliente['activo']?'checked':''?> style="width:34px;height:34px;">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-10">
				<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del cliente" value="<?=$cliente['nombre']?>" required> <span class="badge" id="nombre_count"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">URL</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" name="url" placeholder="http://" value="<?=$cliente['url']?>">
			<p class="help-block">La dirección web a la que irá el visitante al hacer click en el cliente</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Imagen</label>
			<div class="col-sm-10">
				<img src="<?=foto_url($cliente['archivo'],$targ_w,$targ_h)?>" class="img-responsive" alt="<?=$cliente['nombre']?>">
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
		<div class="col-sm-12">
			<canvas></canvas>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
			<a href="clientes.php" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
			<button type="submit" name="subir_cliente" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Guardar</button>
			<input type="hidden" name="id" value="<?=$cliente['id']?>" />
			</div>
		</div>
		</form>
	</div>
