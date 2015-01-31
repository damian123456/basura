<?
 /* FILA */
	function imprimirSelectSubcategorias($children, $selected_id, $level=0){
		$level++;
		if($children) foreach($children as $sc){
?>				<option value="<?=$sc['id']?>" <?if($sc['id']==$selected_id){?>selected<?}?>><?=str_repeat('-',$level*2)?> <?=$sc['nombre']?></option><?
			if($sc['children']) imprimirSelectSubcategorias($sc['children'],$selected_id,$level);
		}
	}
?>

<form class="form-horizontal" role="form" method="post" action="">

	<div class="tab-content">

<?// INFO PANEL ?>
		<div class="tab-pane active" id="info">

			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="title">1</label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="col1f1" placeholder="Col1-F1" value="<?=getValue($item,'col1f1')?>" required>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="title">2</label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="col2f1" placeholder="Col2-F1" value="<?=getValue($item,'col2f1')?>" required>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="title">3</label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="col3f1" placeholder="Col3-F1" value="<?=getValue($item,'col3f1')?>" required>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="title">4 (opcional)</label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="col3f2" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,'col3f2')?>" required>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="excerpt">5 (opcional)</label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="excerpt" name="content" placeholder="Resumen"><?=getValue($item,'content')?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="excerpt">6 (opcional)</label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="excerpt" name="excerpt" placeholder="Resumen"><?=getValue($item,'excerpt')?></textarea>
				</div>
			</div>

<!--
			<div class="form-group">
				<label class="col-sm-2 control-label" for="title">1 (Contenido principal)</label>	
				<div class="col-sm-10 course-body">
					<textarea id="editor" name="content"><?=htmlentities(getValue($item,'content'),ENT_COMPAT | ENT_HTML401,$charset)?></textarea>
				</div>
			</div>
		-->

<!--"MOSTRAR EXPLICACION DE CURSOS"

			<div class="form-group">
				<label class="col-sm-2 control-label" for="show_courses_explanations">Mostrar explicaci&oacute;n de cursos</label>
				<div class="col-sm-10">
					<input type="checkbox" name="show_courses_explanations" id="show_courses_explanations" <?=$item['show_courses_explanations']?'checked':''?> style="width:34px;height:34px;">
				</div>
			</div>

			-->


		</div>


	</div>

<? /*if(!$item){ ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10 well" style="text-align:right">
			<small>Guarde los cambios para continuar con la carga de la tabla</small>
		</div>
	</div>
<? } */?>

	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10 form-controls">
			<button type="button" onclick="location.href='tbl_cursos.php'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Volver</button>
			<button type="submit" class="btn btn-primary" >Guardar</button>

			<input type="hidden" name="save" value="1" >
			<input type="hidden" name="id" id="courseId" value="<?=$item['id']?>" >
		</div>
	</div>
</form>

<!-- Properties Modal -->
<form role="form" action="ajax/tbl_cursos.php" class="modal fade" id="addProperty" tabindex="-1" role="dialog" aria-labelledby="#myModalLabel2" aria-hidden="true">
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
<script type="text/javascript">
$(function(){
	$('#editor').summernote({
		height:400,

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
		$('#editor').html($('#editor').code());
//		$('#editor-input').val($('#editor').code());
//		ev.preventDefault();
	});
	$('a[href="'+location.hash+'"]').tab('show')
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		window.history.pushState(false,false,this.href);
	})
});
</script>
