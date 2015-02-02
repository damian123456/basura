<div class="text-right">
	<a href="testimonios.php?action=new" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>  Añadir Testimonios</a>
	<a href="../quienes-somos" class="btn btn-default" target="_blank"><span class="fa fa-globe"></span>  Ver online</a>
</div>
<div style="clear:both"></div>
<div class="separador">&nbsp;</div>

<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading"><strong>Testimonios</strong></div>
<?	// Traemos los testimonios
		$testimonios = $db->fetch_all("
			SELECT t.*, c.nombre AS categoria FROM testimonios AS t
				JOIN categorias AS c
					ON c.id = t.id_categoria
			ORDER BY orden
		");
?>
	<div class="panel-body" style="background:#f9f9f9">
<?
		if($testimonios){
?>
		<ul id="sortable" class="row" style="list-style:none;margin:0;padding:0">
<?		foreach($testimonios as $k => $t){
				if($t['archivo']){
					$foto = foto_url($t['archivo'], $targ_w, $targ_h);
				} else {
					$foto = url('img/about-testimonial-default.jpg');
				}
?>
		  <li id="testimonio_<?=$t['id']?>" class="col-sm-3">
			<div class="thumbnail">
				<img src="<?=$foto?>" class="img-responsive" alt="...">
			  <div class="caption">
				<hr />
				<p class="text-center"><?=$t['texto']?></p>
				<hr />
				<p class="text-center">
					<a href="testimonios.php?action=state&id_testimonio=<?=$t['id']?>" class="btn btn-<?=($t['online']?'danger':'success')?>" data-toggle="tooltip" data-placement="left" title="<?=($t['online']?'Desactivar':'Activar')?>"><i class="fa <?=($t['online']?'fa-power-off':'fa-check-square-o')?>"></i></a>
					<a href="testimonios.php?action=edit&id_testimonio=<?=$t['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
					<a href="testimonios.php?action=delete&id_testimonio=<?=$t['id']?>" class="btn btn-default" onClick="return confirm('¿Seguro que desea eliminar este testimonio?');"><span class="glyphicon glyphicon-trash"></span></a>
				</p>
			  </div>
			</div>
		  </li>
<?		} ?>
		</ul>
<?		}else{ ?>
		<p class="text-center">No hay testimonios</p>
<?		} ?>
	</div>
</div>

