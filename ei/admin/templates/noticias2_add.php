

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
			<input type="text" name="titulo" style="width:48%;" class="form-control" placeholder="Titulo de la noticia" value="<?=getValue($item,'titulo')?>" required>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label">Contenido</label>
	<div class="col-sm-5">
				<textarea style="height:200px;" type="text" name="contenido" class="form-control" placeholder="Contenido" required><?=getValue($item,'contenido')?></textarea>
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
			<img id="img" class="crop" src="#" alt="imagen" />
        </div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10 form-controls" style="padding-right:43%;">
			<button type="button" onclick="location.href='noticias.php'" id="boton" class="btn btn-default" rel="external"><i class="fa fa-chevron-left"></i> Volver</button>
			<button type="submit" name="subir_banner" class="btn btn-primary" rel="external">Guardar</button>
			<input type="hidden" id="save" name="save" value="1" >
			<input type="hidden" name="id" value="<?=$item['id']?>" >
		</div>
	</div>
</form>

<script type="text/javascript">
	var a;
	function readURL(input) {
		
		var img = document.createElement("img");
		        		if (input.files && input.files[0]) {
            var reader = new FileReader();			reader.onload = function (e) {
				
				img.src = e.target.result
				var width = img.width;
				var height = img.height;

				if(width < <?=$targ_w?> || height < <?=$targ_h?>){
					alert("La imagen debe medir al menos <?=$targ_w?>x<?=$targ_h?>px");
					return;
				}
				
				$('.image_view').hide();
				$('#img').attr('src', e.target.result);				
                $('.crop').Jcrop({					onSelect: updateCoords,					trueSize: [ width, height ],
					aspectRatio: (<?=$targ_w?> / <?=$targ_h?>),
					minSize: [<?=$targ_w?>, <?=$targ_h?>],
					bgOpacity: .4
				});			}
						reader.readAsDataURL(input.files[0]);		}	}
    
    $("#archivo").change(function(){		console.log(this);		readURL(this);	});

	function updateCoords(c){
		a = {
			x: Math.ceil(c.x),
			y: Math.ceil(c.y),
			w: Math.round(c.w),
			h: Math.round(c.h)
			};
		$('#x').val(Math.ceil(a.x));
		$('#y').val(Math.ceil(a.y));
		$('#w').val(Math.round(a.w));
		$('#h').val(Math.round(a.h));
		$('#coords').val(JSON.stringify(a));
	};
	$(document).ready(function(){
		$('#img').hide();
		$('#archivo').live("change", readURL);
	});
</script>