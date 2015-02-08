<div class="center">
	<a href="home_slideshow.php?action=new" class="btn-lg btn-primary"><i class="fa fa-plus"></i> Añadir Diapositiva</a>
</div>
<div class="separador">&nbsp;</div>
<?	if($items){	?>
	<table id="sort" class="table table-striped">
		<!-- On rows -->
		<thead>
			<tr class="active">
				<th class="hidden-xs">Vista previa</th>
				<th>T&iacute;tulo</th>
				<th class="hidden-xs">Agregado</th>
				<th class="hidden-xs">Modificado</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
<?	foreach($items as $k => $item){   ?>
			<tr id="slide_<?=$item['id']?>">
				<td class="hidden-xs" width="20%">
					<img src="<?=$upload_dir.$item['image']?>" class="img-responsive"/>
				</td>
				<td width="25%"><?=$item['title']?></td>
				<td class="hidden-xs" width="20%"><?=$item['added']?></td>
				<td class="hidden-xs" width="20%"><?=$item['modified']?></td>
				<td>
					<a href="../" target="_blank" class="btn btn-primary"><span class="fa fa-globe"></span></a>
					<a href="home_slideshow.php?id=<?=$item['id']?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
					<a href="home_slideshow.php?action=delete&id=<?=$item['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar este item?');"><span class="fa fa-trash-o"></span></a>
				</td>
			</tr>
<?	} ?>
		</tbody>
	</table>
<?	}else{	?>
	<p class="text-center">No hay contenido para el slide de la pagina principal.</p>
<?	}	?>
</div>
