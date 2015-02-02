	<div class="text-right">
		<a href="banners.php?action=new" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>  Añadir Banner</a>
		<a href="/" class="btn btn-default"><span class="fa fa-globe"></span>  Ver online</a>
		<div class="btn-group">
			<button class="btn btn-default">Filtrar por</button>
			<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="banners.php?list=home"><strong>Banners de pagina principal</strong></a></li>
				<li><a href="banners.php?list=categoria">Banners de cursos</a></li>
			</ul>
		</div>
	</div>
	<div style="clear:both"></div>
	<div class="separador">&nbsp;</div>
<?	if($secciones) foreach($secciones as $seccion){	?>

	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><strong><?=$seccion['nombre']?></strong></div>
<?		// Traemos los banners
		$banners = $db->fetch_all("
			SELECT b.*, s.nombre AS seccion, c.nombre AS categoria FROM banners AS b
				LEFT JOIN secciones AS s
					ON s.id = b.id_seccion
				LEFT JOIN categorias AS c
					ON c.id = b.id_categoria
			WHERE id_seccion = {$seccion['id']}
			GROUP BY b.id
			ORDER BY b.orden
		");
?>
	<div class="panel-body" style="background:#f9f9f9">
<?	
		if($banners){
?>
		<?/*<table class="table">
			<!-- On rows -->
			<thead>
				<tr class="active">
					<th class="hidden-xs">Vista previa</th>
					<th>Nombre</th>
					<th>Sección</th>
					<th class="hidden-xs">URL</th>
					<th class="center">Editar</th>
				</tr>
			</thead>
			<tbody>
	<?		foreach($banners as $k => $banner){ ?>
				<tr>
					<td class="hidden-xs center"><img src="<?=foto_url($banner['archivo'], 60, 60)?>" class="img-responsive" /></td>
					<td><?=($banner['categoria']?'(Categoría)':$banner['titulo'])?> <?=$banner['titulo_2']?></td>
					<td><?=($banner['seccion']?$banner['seccion']:$banner['categoria'])?></td>
					<td class="hidden-xs"><?=$banner['url']?></td>
					<td class="center">
						<a href="/" class="btn btn-primary" target="_blank"><i class="fa fa-globe"></i></a>
						<a href="banners.php?action=edit&id_banner=<?=$banner['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
						<a href="banners.php?action=delete&id_banner=<?=$banner['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar este banner?');"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
	<?		} ?>
			</tbody>
		</table>*/?>
		<ul id="sortable_<?=$seccion['id']?>" class="row" style="list-style:none;margin:0;padding:0">
<?		foreach($banners as $k => $banner){ ?>		
		  <li id="banner_<?=$seccion['id']?>_<?=$banner['id']?>" class="col-sm-3">
			<div class="thumbnail">
<?			if(!$banner['url_youtube']){	?>
				<img src="<?=foto_url($banner['archivo'], 240, 160)?>" class="img-responsive" alt="...">
<?			}else{	
				$pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
				$youtube_id = (preg_replace($pattern, '$1', $banner['url_youtube']));
?>
				<iframe width="100%" class="img-responsive" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe>
<?			}	?>
			  <div class="caption">
				<hr />
				<p class="text-center"><?=$banner['titulo']?></p>
				<hr />
				<p class="text-center">
					<a href="banners.php?action=state&id_banner=<?=$banner['id']?>" class="btn btn-<?=($banner['activo']?'success':'danger')?>" data-toggle="tooltip" data-placement="left" title="<?=($banner['activo']?'Desactivar':'Activar')?>"><i class="fa <?=($banner['activo']?'fa-check-square-o':'fa-power-off')?>"></i></a>
					<a href="banners.php?action=edit&id_banner=<?=$banner['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
					<a href="banners.php?action=delete&id_banner=<?=$banner['id']?>" class="btn btn-default" onClick="return confirm('¿Seguro que desea eliminar este banner?');"><span class="glyphicon glyphicon-trash"></span></a>
				</p>
			  </div>
			</div>
		  </li>
<?		} ?>
		</ul>
<?		}else{ ?>
		<p class="text-center">No hay banners en esta sección</p>
<?		} ?>
	</div>
</div>
<?	}	?>
<?	
	// Traemos los banners
	$banners = $db->fetch_all("
		SELECT b.*, s.nombre AS seccion, c.nombre AS categoria FROM banners AS b
			LEFT JOIN secciones AS s
				ON s.id = b.id_seccion
			LEFT JOIN categorias AS c
				ON c.id = b.id_categoria
		WHERE id_seccion = 0
		AND id_categoria = 0
		GROUP BY b.id
		ORDER BY b.orden
	");

	if($banners){
?>
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><strong>Sin Categoría</strong></div>
	<div class="panel-body" style="background:#f9f9f9">
		<ul id="sortable_<?=$seccion['id']?>" class="row" style="list-style:none;margin:0;padding:0">
<?		foreach($banners as $k => $banner){ ?>		
		  <li id="banner_<?=$seccion['id']?>_<?=$banner['id']?>" class="col-sm-3">
			<div class="thumbnail">
			  <img src="<?=foto_url($banner['archivo'], 240, 0)?>" class="img-responsive" alt="...">
			  <div class="caption">
				<hr />
				<p class="text-center">Categoría: <?=($banner['categoria']?$banner['categoria']:'Sin categoría')?></p>
				<hr />
				<p class="text-center">
					<a href="banners.php?action=state&id_banner=<?=$banner['id']?>" class="btn btn-<?=($banner['activo']?'warning':'success')?>" data-toggle="tooltip" data-placement="left" title="<?=($banner['activo']?'Desactivar':'Activar')?>"><i class="fa <?=($banner['activo']?'fa-power-off':'fa-check-square-o')?>"></i></a>
					<a href="banners.php?action=edit&id_banner=<?=$banner['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
					<a href="banners.php?action=delete&id_banner=<?=$banner['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar este banner?');"><span class="glyphicon glyphicon-trash"></span></a>
				</p>
			  </div>
			</div>
		  </li>
<?		} ?>
		</ul>
	</div>
</div>
<?	} ?>
