<?
	if(!$_GET['type']){
?>
	<div class="center">
		<p style="padding-bottom:5px">Seleccione la ubicación del banner:</p>
		<!--<a href="banners.php?action=new&type=home" class="btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Página principal</a>-->&nbsp;
		<a href="banners.php?action=new&type=category" class="btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Categoría</a>
	</div>
<?
	}
	switch($_GET['type']){

		case 'home':
?>
		<form class="form-horizontal" role="form" method="post" action="banners.php?action=upload&type=home" enctype="multipart/form-data">
			<div class="form-group">
			<label class="col-sm-2 control-label">Publicar</label>
			<div class="col-sm-10">
				<input type="checkbox" name="activo" id="activo" style="width:34px;height:34px;"></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Titulo</label>
			<div class="col-sm-5">
				<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo del banner" required> <span class="badge" id="titulo_count"></span>
			</div>
			<div class="hidden-sm hidden-md hidden-lg">&nbsp;</div>
			<div class="col-sm-5">
				<input type="text" name="titulo_2" id="titulo_2" class="form-control" placeholder="Titulo Segundo color"> <span class="badge" id="titulo_2_count"></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Detalles</label>
			<div class="col-sm-10">
				<input type="text" name="detalles" id="detalles" class="form-control" placeholder="Detalles (opcional)"> <span class="badge" id="detalles_count"></span>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Ubicación</label>
			<div class="col-sm-10">
<?			                if($secciones){   ?>
				<select class="form-control" name="ubicacion">
<?                        			foreach($secciones as $s){    ?>
					<option value="<?=$s['id']?>"><?=$s['nombre']?></option>
<?                        			} ?>
				</select>

<?                			}else{ ?>
				<p class="help-block"><strong>Importante: </strong> primero debes <a href="secciones.php">agregar una secci&oacute;n</a></p>
<?                			} ?>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Video de Youtube</label>
			<div class="col-sm-10">
				<input type="text" name="url_youtube" class="form-control" id="url_youtube">
				<p class="help-block">Inserte la URL de un video de Youtube (ej: http://www.youtube.com/watch?v=Hc7oa-e3Blg).</p>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Subir imagen</label>
			<div class="col-sm-10">
				<input type="file" name="archivo" id="archivo">
				<input type="hidden" name="coords" id="coords" >
				<p class="help-block">Seleccione una imagen.</p>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">URL</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="url" placeholder="http://" value="http://" required>
				<p class="help-block">La dirección web a la que irá el visitante al hacer click en el banner</p>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Texto del botón</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="texto_boton" placeholder="Texto del botón">
			</div>
			</div>
		<div class="col-sm-12">
			<canvas></canvas>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
			<a href="banners.php?action=new" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
			<button type="submit" name="subir_banner" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Subir</button>
			</div>
		</div>
		</form>
<?
		break;

	case 'category':
		$categorias = $db->fetch_all("SELECT * FROM categorias WHERE parent = 0");
?>
		<form class="form-horizontal" role="form" method="post" action="banners.php?action=upload&type=category" enctype="multipart/form-data">
			<div class="form-group">
			<label class="col-sm-2 control-label">Publicar</label>
			<div class="col-sm-10">
				<input type="checkbox" name="activo" id="activo" style="width:34px;height:34px;"></span>
			</div>
			</div>
<?              		  if($categorias){   ?>
			<div class="form-group">
			<label class="col-sm-2 control-label">Categoría</label>
			<div class="col-sm-10">
				<select class="form-control" name="id_categoria">
<?                       		 foreach($categorias as $c){    ?>
					<option value="<?=$c['id']?>"><?=$c['nombre']?></option>
<?                          		$subcategorias = $db->fetch_all("SELECT * FROM categorias WHERE parent = '{$c['id']}'");
					if($subcategorias) foreach($subcategorias as $sc){  ?>
					<option value="<?=$sc['id']?>">--- <?=$sc['nombre']?></option>
<?                  		        } ?>
<?      		                  } ?>
				</select>
			</div>
			</div>
<?	                } ?>
			<div class="form-group">
			<label class="col-sm-2 control-label">Video de Youtube</label>
			<div class="col-sm-10">
				<input type="text" name="url_youtube" class="form-control" id="url_youtube">
				<p class="help-block">Inserte la URL de un video de Youtube (ej: http://www.youtube.com/watch?v=Hc7oa-e3Blg).</p>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Subir imagen</label>
			<div class="col-sm-10">
				<input type="file" name="archivo" id="archivo">
				<input type="hidden" name="coords" id="coords" >
				<p class="help-block">Seleccione una imagen.</p>
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">URL</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="url" placeholder="http://" value="http://" required>
				<p class="help-block">La dirección web a la que irá el visitante al hacer click en el banner</p>
			</div>
			</div>
			<div class="col-sm-12">
			<canvas></canvas>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
				<a href="banners.php?action=new" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
				<button type="submit" name="subir_banner_category" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Subir</button>
				<input type="hidden" name="list" value="categoria" />
			</div>
			</div>
		</form>
<?
		break;
	}
