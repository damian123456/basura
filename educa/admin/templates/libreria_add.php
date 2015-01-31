<?php 
    $catego = $db->fetch_item("SELECT * FROM categorias_libros WHERE id = '{$item['categoria']}'");
?>

<form class="form-horizontal" id="form" role="form" method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-sm-2 control-label">Publicar</label>
		<div class="col-sm-10">
			<input type="checkbox" name="activo" id="activo" class="form-control" <?=$item['activo']?'checked':''?> style="width:34px;height:34px;"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="title">T&iacute;tulo</label>
		<div class="col-sm-10">
			<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo del libro" value="<?=getValue($item,'titulo')?>" required>
		</div>
	</div>
    <div class="form-group">
		<label class="col-sm-2 control-label" for="title">Categor&iacute;a</label>
		<div class="col-sm-10">
			<input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria del libro" value="<?=getValue($catego,'nombre')?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="title">Autor</label>
		<div class="col-sm-10">
			<input type="text" name="autor" id="autor" class="form-control" placeholder="Autor del libro" value="<?=getValue($item,'autor')?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="title">Editorial</label>
		<div class="col-sm-10">
			<input type="text" name="editorial" id="editorial" class="form-control" placeholder="Editorial del libro" value="<?=getValue($item,'editorial')?>">
		</div>
	</div>
	
	<div class="form-group">
		<?if($item){?>
		<div class="col-sm-12">
			<img alt="<?=$item['titulo']?>" src="<?=$upload_dir.$item['imagen']?>" class="image_view">
		</div>
		<label class="col-sm-2 control-label">Cambiar imagen</label>
		<?} else {?>
		<label class="col-sm-2 control-label">Subir imagen</label>
		<?}?>
		<div class="col-sm-10">
			<input type="file" name="archivo" id="archivo">
			<input type="hidden" name="coords" id="coords" >
			<p class="help-block">Seleccione una imagen.</p>
		</div>
		<div class="col-sm-12">
			<canvas></canvas>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10 form-controls">
			<button type="button" onclick="location.href='libreria.php'" id="boton" class="btn btn-default" rel="external"><i class="fa fa-chevron-left"></i> Volver</button>
			<button type="submit" name="subir_banner" class="btn btn-primary" rel="external">Guardar</button>
			<input type="hidden" id="save" name="save" value="1" >
			<input type="hidden" name="id" value="<?=$item['id']?>" >
		</div>
	</div>
</form>

<script type="text/javascript">
	function renderImage(ev){
		var file = this.files[0];
		var canvas = $('canvas')[0];
		var img = document.createElement("img");

		var reader = new FileReader();
		reader.onload = (function(img,canvas){
			return function(e) {
				img.src = e.target.result

				var width = img.width;
				var height = img.height;

				if(width < <?=$targ_w?> || height < <?=$targ_h?>){
					alert("La imagen debe medir al menos <?=$targ_w?>x<?=$targ_h?>px");
					return;
				}

				canvas.width = width;
				canvas.height = height;
				var ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0, width, height);

				canvas.style.maxWidth = '100%';
				canvas.style.height = 'auto';
				$('.image_view').hide();

				$(canvas).Jcrop({
					onChange: setCoords,
					trueSize: [ width, height ],
					aspectRatio: (<?=$targ_w?> / <?=$targ_h?>),
					minSize: [<?=$targ_w?>, <?=$targ_h?>],
					bgOpacity: .4,
					setSelect: [ 0, 0, <?=$targ_w?>, <?=$targ_h?> ]
				});
			}
		})(img,canvas);

		reader.readAsDataURL(file);
	}

	function setCoords(c){
		var a = {
			x: Math.ceil(c.x),
			y: Math.ceil(c.y),
			w: Math.round(c.w),
			h: Math.round(c.h)
		};
		$('#coords').val(JSON.stringify(a));
	}

	function checkCoords(){
		if ($('#coords').val().length > 0) return true;
		alert('Por favor, seleccione un área en la imagen para recortar antes de presionar el boton "Guardar".');
		return false;
	};

	$(document).ready(function(){
		$('#archivo').change(renderImage);
	});
</script>
