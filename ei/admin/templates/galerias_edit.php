<?
	if($galeria['id']>0){
		$targ_w = 300;
		$targ_h = 250;
?>		<h3>Editar galería</h3><br><br>
		<form class="form-horizontal" role="form" method="post" action="galerias.php?action=upload" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label">Nombre</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="nombre" id="nombre" value="<?=$galeria['nombre']?>">
				</div>	
			</div>	
			<div class="form-group">
				<label class="col-sm-2 control-label">Categoría</label>
				<div class="col-sm-4">
					<select class="form-control" name="categoria">
						<option value="0" <?php if($galeria['categoria']==0) echo 'selected';?>>General</option>
						<option value="1" <?php if($galeria['categoria']==1) echo 'selected';?>>Prensa</option>
						<option value="2" <?php if($galeria['categoria']==2) echo 'selected';?>>Viajes Culturales</option>
			    	</select>
				</div>
			</div>
				
			<div class="form-group">
			<label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
				<a href="galerias.php" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
				<button type="submit" name="subir_galeria" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Guardar</button>
				<input type="hidden" name="id" value="<?=$galeria['id']?>" />
			</div>
			</div>
		</form>
	<? } ?>
	


