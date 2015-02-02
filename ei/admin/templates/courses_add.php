<?

/* YO */
			/*	$categories = $db->fetch_all("
					SELECT c.* FROM categorias AS c ORDER BY c.parent,c.orden,c.nombre ASC
				");

/* FIN YO*/
	function imprimirSelectSubcategorias($children, $selected_id, $level=0){
		$level++;
		if($children) foreach($children as $sc){
?>				<option value="<?=$sc['id']?>" <?if($sc['id']==$selected_id){?>selected<?}?>><?=str_repeat('-',$level*2)?> <?=$sc['nombre']?></option><?
			if($sc['children']) imprimirSelectSubcategorias($sc['children'],$selected_id,$level);
		}
	}
?>





<form class="form-horizontal" role="form" method="post" action="">

<? if($item){ ?>
	<ul class="nav nav-pills">
		<li class="active"><a href="#info" data-toggle="tab">Informaci&oacute;n</a></li>
		<li><a href="#varieties" data-toggle="tab">Modalidades</a></li>
	</ul>
<? } ?>

	<div class="tab-content">

<?// INFO PANEL ?>
		<div class="tab-pane active" id="info">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="title">T&iacute;tulo</label>

				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Nombre del contenido" value="<?=getValue($item,'title')?>" required>
				</div>
			</div>


			<div class="form-group">

				<label class="col-sm-2 control-label" for="excerpt">Resumen</label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="excerpt" name="excerpt" placeholder="Resumen del contenido"><?=getValue($item,'excerpt')?></textarea>
				</div>
			</div>

<?/* ACA ME METI YO 

<?	if($categorias){   ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Es subcategor&iacute;a de:</label>
		<div class="col-sm-10">
			<select class="form-control" name="parent">
				<option value="0">-- NINGUNA --</option>
<?		foreach($categorias as $c){    ?>
				<option value="<?=$c['id']?>" <?if($c['id']==$categoria['parent']){?>selected<?}?>><?=$c['nombre']?></option>
<?			imprimirSelectSubcategorias($c['children'],$categoria['parent']) ?>
<?		} ?>
			</select>
		</div>
	</div>
	<?	} ?>

ACA TERMINE YO */?>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="category">Categor&iacute;a</label>
				<div class="col-sm-10">
					<select class="form-control" id="category" name="category">
<?				foreach($categories as $c){    ?>
						<option value="<?=$c['id']?>" <?if($c['id']==$item['id_category']){?>selected<?}?>><?=str_repeat('-',$level*2)?><?=$c['nombre']?></option>
						<?imprimirSelectSubcategorias($c['children'],$item['id_category'])?>
<?				} ?>
					</select>
					<?=(!$categories?'<p class="help-block"><strong>Importante:</strong> Primero debes <a href="categorias.php">agregar una categor&iacute;a</a></p>':'')?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="content">Contenido</label>
				<div class="col-sm-10 course-body">
					<textarea class="editor" name="content"><?=htmlentities(getValue($item,'content'),ENT_COMPAT | ENT_HTML401,$charset)?></textarea>
				</div>
			</div>
			
			<div class="tablas">

				<div class="form-group">
					<label class="col-sm-2 control-label" for="excerpt">Color</label>
					<div class="col-sm-8">
						<input type="text" class="form-control tabla" id="hexa" name="hexa" value="<?=getValue($item,'color')?>">
					</div>
					<button class="btn dropdown-toggle" data-toggle="dropdown">
						<select id="colorselector_1">
							<option value="3b9b42" data-color="#3b9b42" selected="selected">verde</option>
							<option value="1ab88d" data-color="#1ab88d">petroleo</option>
							<option value="e9880c" data-color="#e9880c">naranja</option>
							<option value="cf0063" data-color="#cf0063">magenta</option>
							<option value="15456d" data-color="#15456d">azul</option>
						</select>
			  		</button>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="content">Contenido</label>
					<div class="col-sm-10 course-body">
						<textarea class="tabla editor" name="content"><?=htmlentities(getValue($item,'content'),ENT_COMPAT | ENT_HTML401,$charset)?></textarea>
					</div>
				</div>
			</div>
			

			<div class="form-group">
				<label class="col-sm-2 control-label" for="content">Pie de Contenido</label>
				<div class="col-sm-10 course-body">
					<textarea class="editor" name="content"><?=htmlentities(getValue($item,'content'),ENT_COMPAT | ENT_HTML401,$charset)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="show_courses_explanations">Mostrar explicaci&oacute;n de cursos</label>
				<div class="col-sm-10">
					<input type="checkbox" name="show_courses_explanations" id="show_courses_explanations" <?=$item['show_courses_explanations']?'checked':''?> style="width:34px;height:34px;">
				</div>
			</div>

		</div>

<?// VARIATIONS PANEL ?>
		<div class="tab-pane" id="varieties">

<?	if(count($item['variations'])) foreach($item['variations'] as $v) { ?>
			<div class="col-md-6">

				<h4><?=$v['title']?></h4>
				<div class="form-group">
					<label for="inputPrice<?=$v['id']?>" class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-9">
						<input type="number" class="form-control" id="inputPrice<?=$v['id']?>" placeholder="0.00" name="variations_prices[<?=$v['id']?>]" value="<?=$v['price']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputMonthlyPrice<?=$v['id']?>" class="col-sm-3 control-label">Precio Mensual</label>
					<div class="col-sm-9">
						<input type="number" class="form-control" id="inputMonthlyPrice<?=$v['id']?>" placeholder="0.00" name="variations_monthly_prices[<?=$v['id']?>]" value="<?=$v['monthly_price']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputDuration<?=$v['id']?>" class="col-sm-3 control-label">Duraci&oacute;n</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="inputDuration<?=$v['id']?>" placeholder="Ej: 4 Meses" name="variations_durations[<?=$v['id']?>]" value="<?=$v['duration']?>">
					</div>
				</div>
				<div class="form-group" style="display:none">
					<label for="inputPaymentGateway<?=$v['id']?>" class="col-sm-3 control-label">URL de pago</label>
					<div class="col-sm-9">
<!--						<input type="text" class="form-control" id="inputPaymentGateway<?=$v['id']?>" name="variations_payment_gateway_url[<?=$v['id']?>]" value="<?=$v['payment_gateway_url']?>"> -->
						<input type="text" class="form-control" id="inputPaymentGateway<?=$v['id']?>" name="variations_payment_gateway_url[<?=$v['id']?>]" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPaymentGateway<?=$v['id']?>" class="col-sm-3 control-label">Modalidad gratuita</label>
					<div class="col-sm-9" style="margin-top:15px">
						<input type="checkbox" id="inputFreeVariation<?=$v['id']?>" name="variations_free_variation[<?=$v['id']?>]" <?=($v['free_variation']?'checked="checked"':'')?>>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPaymentGateway<?=$v['id']?>" class="col-sm-3 control-label">Disponible para compra</label>
					<div class="col-sm-9" style="margin-top:15px">
						<input type="checkbox" id="inputAvailableCheckbox<?=$v['id']?>" name="variations_available_checkbox[<?=$v['id']?>]" <?=($v['available']?'checked="checked"':'')?>>
					</div>
				</div>
				<hr>
				<ul class="list-group">
	<?			if(is_array($v['items'])) foreach($v['items'] as $it) { ?>
					<li class="list-group-item"><button type="button" class="close" aria-hidden="true">&times;</button><span><?=$it['value']?></span><input type="hidden" name="items[<?=$v['id']?>][]" value="<?=$it['value']?>"></li>
	<?			} ?>
					<li class="list-group-item template">
						<button type="button" class="close" aria-hidden="true">&times;</button>
						<span></span>
						<input type="hidden" name="items[<?=$v['id']?>][]" value="">
					</li>
				</ul>

				<button class="btn btn-default" data-toggle="modal" data-target="#addProperty"><i class="fa fa-plus"></i> Agregar Item</button>

			</div>
<?	} ?>

		</div>
	</div>

<? if(!$item){ ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10 well" style="text-align:right">
			<small>Guarde los cambios para continuar con la carga del curso</small>
		</div>
	</div>
<? } ?>

	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>

	<?/* ME METO */ ?>

		<div class="col-sm-10 form-controls">
			<button type="button" onclick="location.href='courses.php'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Volver</button>
<?		if($item){?>
			<button type="submit" name="apply" class="btn btn-primary" >Aplicar</button>
			<button type="submit" class="btn btn-primary" >Guardar y salir</button>
<?		} else { ?>
			<button type="submit" name="apply" class="btn btn-primary" >Guardar y Continuar <span class="fa fa-chevron-right"></button>
<?		} ?>
			<input type="hidden" name="save" value="1" >
			<input type="hidden" name="id" id="courseId" value="<?=$item['id']?>" >
		</div>

		<? /* FIN ME METO */?>
	</div>
</form>

<!-- Properties Modal -->
<form role="form" action="ajax/courses.php" class="modal fade" id="addProperty" tabindex="-1" role="dialog" aria-labelledby="#myModalLabel2" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel2">Agregar Item</h4>
			</div>
			<div class="modal-body">

				<div class="form-group">
					<label for="propertyNameInput">Valor</label>
					<input type="text" name="value" class="form-control" id="propertyValueInput" placeholder="Valor">
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
				<input type="hidden" name="do" value="saveProperty">
				<input type="hidden" name="courseId" value="<?=$item['id']?>">
				<input type="hidden" name="propertyId" id="propertyId" value="">
			</div>
		</div>
	</div>
</form>

<script type="text/javascript" src="js/bootstrap-wysiwyg.js"></script>
<script>
	$(function() {

		window.prettyPrint && prettyPrint();

		$('#colorselector_1').colorselector({
			callback: function (value, color, title) {
				$("#hexa").val(value);
			}
		});
	});
</script>
<script type="text/javascript">
$(function(){
	$('.editor').summernote({
		height:200,

		lang: 'es-ES',   // language 'en-US', 'ko-KR', ...

		toolbar: [
			['style', ['style']],
			['font', ['clear']],
			//['font', ['bold', 'italic', 'underline', 'clear']],
			//['fontsize', ['fontsize']],
			//['color', ['color']],
			//['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['table', ['table']],
			['insert', ['link', 'picture', 'video']],
			//['view', ['fullscreen', 'codeview']],
			//['help', ['help']]
		]
	});
	$('form').submit(function(ev){
		$('.editor').html($('.editor').code());
//		$('#editor-input').val($('#editor').code());
//		ev.preventDefault();
	});
	$('a[href="'+location.hash+'"]').tab('show')
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		window.history.pushState(false,false,this.href);
	})
});
</script>
