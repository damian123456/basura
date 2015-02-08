<? 
	function imprimirSelectSubcategorias($children, $selected_id, $level=0){
		$level++;
		if($children) foreach($children as $sc){
?>				<option value="<?=$sc['id']?>" <?if($sc['id']==$selected_id){?>selected<?}?>><?=str_repeat('-',$level*2)?> <?=$sc['nombre']?></option><?
			if($sc['children']) imprimirSelectSubcategorias($sc['children'],$selected_id,$level);
		}
	}
?>
<form class="form-horizontal" role="form" method="post" action="<?if($categoria){?>categorias.php?action=edit&id=<?=$id_categoria?><?} else {?>categorias.php?action=add<?}?>" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-10">
			<input type="text" name="nombre" class="form-control" <?if($categoria){?>value="<?=$categoria['nombre']?>"<?}?> placeholder="Nombre de la categoría" required>
		</div>
	</div>
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
	<div class="form-group">
		<label class="col-sm-2 control-label">No mostrar en el menú</label>
		<div class="col-sm-10">
			<input type="checkbox" name="noMostrarEnMenu" id="noMostrarEnMenu" <?=$categoria['noMostrarEnMenu']?'checked':''?> style="width:34px;height:34px;">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Link</label>
		<div class="col-sm-10">
			<input type="text" name="link" class="form-control" <?if($categoria){?>value="<?=$categoria['link']?>"<?}?> placeholder="Enlace">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10">
			<button type="button" onclick="location.href='categorias.php'" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Volver</button>
			<button type="submit" name="nueva_categoria" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> <?if($categoria){?>Guardar<?} else {?>A&ntilde;adir<?}?></button>
		</div>
	</div>
</form>
