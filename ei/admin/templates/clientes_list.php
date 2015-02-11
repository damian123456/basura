	<div class="text-right">
		<a href="clientes.php?action=new" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>  Añadir Cliente</a>
		<a href="../clientes" class="btn btn-default" target="_blank"><span class="fa fa-globe"></span>  Ver online</a>
	</div>
	<div style="clear:both"></div>
	<div class="separador">&nbsp;</div>

	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><strong><?=$seccion['nombre']?></strong></div>
<?		// Traemos los clientes
		$clientes = $db->fetch_all("
			SELECT c.*
			FROM clientes AS c
			ORDER BY c.orden
		");
?>
	<div class="panel-body" style="background:#f9f9f9">
<?
		if($clientes){
?>
		<ul id="sortable" class="row" style="list-style:none;margin:0;padding:0">
<?		foreach($clientes as $k => $cliente){ ?>
		  <li id="cliente_<?=$cliente['id']?>" class="col-sm-3">
			<div class="thumbnail">
				<img src="<?=$upload_dir.$cliente['archivo']?>" class="img-responsive" alt="...">
			  <div class="caption">
				<hr />
				<p class="text-center"><?=$cliente['nombre']?></p>
				<hr />
				<p class="text-center">
					<a href="clientes.php?action=state&id_cliente=<?=$cliente['id']?>" class="btn btn-<?=($cliente['activo']?'danger':'success')?>" data-toggle="tooltip" data-placement="left" title="<?=($cliente['activo']?'Desactivar':'Activar')?>"><i class="fa <?=($cliente['activo']?'fa-power-off':'fa-check-square-o')?>"></i></a>
					<a href="clientes.php?action=edit&id_cliente=<?=$cliente['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
					<a href="clientes.php?action=delete&id_cliente=<?=$cliente['id']?>" class="btn btn-default" onClick="return confirm('¿Seguro que desea eliminar este cliente?');"><span class="glyphicon glyphicon-trash"></span></a>
				</p>
			  </div>
			</div>
		  </li>
<?		} ?>
		</ul>
<?		}else{ ?>
		<p class="text-center">No hay clientes</p>
<?		} ?>
	</div>
</div>
