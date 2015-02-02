<div class="center">

	<div class="col-sm-8">
		<img src="<?=$upload_dir.$banner['archivo']?>" id="imagen_banner" class="img-responsive" />
	</div>
	<div class="col-sm-4">
		<p class="alert alert-warning">
			<strong>Instrucciones</strong><br />
			Seleccione un área a recortar para que se adapte al tamaño necesario del banner, luego haga click en:
			<form action="banners.php?action=cropping" method="post" onsubmit="return checkCoords();">
				<input type="hidden" id="x" name="x" />
				<input type="hidden" id="y" name="y" />
				<input type="hidden" id="w" name="w" />
				<input type="hidden" id="h" name="h" />
				<input type="hidden" id="id_banner" name="id_banner" value="<?=$id_banner?>" />
				<input type="hidden" name="type" value="<?=$_GET['type']?>" />
				<input type="submit" class="btn-lg btn-primary" value="Cortar imagen" />
			</form>
		</p>
	</div>
</div>
