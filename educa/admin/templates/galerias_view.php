<div class="text-right">
	<a href="galerias.php?action=addContent&id_galeria=<?=$galeria['id']?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Añadir contenido</a>
</div>
<div style="clear:both"></div>
<div class="separador">&nbsp;</div>
<?
	$dir="../uploads/galerias/".$galeria['id'];  //nombre de la carpeta
	
	$id=$galeria['id'];
	if($id>0){
		$targ_w = 300;
		$targ_h = 250;
?>
		<form class="form-horizontal" role="form" method="post" action="galerias.php" enctype="multipart/form-data">
		
			<?
			$contenido = $db->fetch_all("
			SELECT * FROM galerias_contenido 
			WHERE id_galeria = {$id}
			ORDER BY orden");
			if ($contenido) {
				$idC=$contenido['id'];
			?>	
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Contenido</strong></div>
						<div class="panel-body" style="background:#f9f9f9">
							<ul id="sortable" class="row" style="list-style:none;margin:0;padding:0">
								<?foreach($contenido as $k => $content){ ?>		
									<li id=content_"<?=$content['id']?>" class="col-sm-3">
										<div class="thumbnail">
										<?if(!$content['url_youtube']){	?>
											<img src="<?=$dir."/".$content['archivo']?>" width="200" id="img" name="img" height="130" class="img-responsive" alt="..."><?'."\n" '?>
										<?}else{		
											$pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
											$youtube_id = (preg_replace($pattern, '$1', $content['url_youtube']));
											?>			
											<iframe width="100%" class="img-responsive" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe>
										<?}	?>
											<div class="caption">
												<hr />
												<p class="text-center"><?=($content['titulo']?$content['titulo']:'Sin titulo')?></p>
												<hr />
												<p class="text-center">
													<a href="galerias.php?action=editContent&id_content=<?=$content['id']?>&id_galeria=<?=$content['id_galeria']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
													<a href="galerias.php?action=deleteContent&id_content=<?=$content['id']?>&id_galeria=<?=$content['id_galeria']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar este contenido?');"><span class="glyphicon glyphicon-trash"></span></a>
												</p>
											</div>
										</div>
									</li>
								<?} ?>
							</ul>
						</div>
					</div>

			<?}	
			else {?>
				<div class="form-group">
					<label class="col-sm-2 control-label">No hay contenido</label>
				</div>
			<?}
			?>			
			
			<div class="form-group">
			<label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
				<a href="galerias.php" class="btn-lg btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
				<!--button type="submit" name="subir_galeria" class="btn-lg btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span> Guardar</button-->
				<input type="hidden" name="id" value="<?=$galeria['id']?>" />
			</div>
			</div>
		</form>
	<? } ?>
	<script>
	$("#sortable").sortable({
			update: function(event, ui) {
				var orden = $(this).sortable('toArray').toString();
				$.get('order.php', {orden:orden, order_general:'1'});
			}
		}).disableSelection();
	</script>
	


