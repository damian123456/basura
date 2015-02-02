<h3>Nueva galería</h3><br><br>
		<form class="form-horizontal" role="form" method="post" action="galerias.php?action=upload&type=home" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label">Nombre</label>
				<div class="col-sm-5">
					<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la galería" required></span>
				</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Categoría</label>
				<div class="col-sm-4">
					<select class="form-control" name="categoria">
						<option value="0">General</option>
						<option value="1">Prensa</option>
						<option value="2">Viajes Culturales</option>
			    	</select>
				</div>
			</div>
			
		<div class="form-group">
			<label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
			<a href="galerias.php" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
			<button type="submit" name="subir_galeria" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Subir</button>
			</div>
		</div>
		</form>

