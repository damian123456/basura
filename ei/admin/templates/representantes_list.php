
<div class="center">
		<a href="representantes.php?action=new" class="btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo representante</a>
</div>
<?
$repre = $db->fetch_all('SELECT * FROM representantes ORDER BY id DESC');
?>
<div class="separador">&nbsp;</div>
<?				  
	if($repre){   ?>
		<table id="sort" class="table table-striped">
				<!-- On rows -->
				<thead>
						<tr class="active">
								<th>Nombre</th>
								<th>País</th>
								<th>Dirección</th>
								<th>Editar</th>
						</tr>
				</thead>
				<tbody>
<?						foreach($repre as $rep){  ?>
						<tr id="representante_<?=$rep['id']?>">
								<td><?=$rep['nombre']?></td>
								<?							
								if (!empty($rep['id_pais'])) {
									$pais = $db->fetch_all("SELECT * FROM country WHERE id=".$rep['id_pais']);
									foreach($pais as $p){  ?>
									<td><?=$p['Name']?></td>
									<?}?>
								<?}else{?>
									<td></td>
								<?}?>
								<td><?=$rep['direccion']?></td>
								<td>
									<a href="representantes.php?action=edit&id=<?=$rep['id']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
									<a href="representantes.php?action=active&id=<?=$rep['id']?>" class="btn btn-<?=($rep['activo']?'success':'danger')?>" data-toggle="tooltip" title="<?=($rep['online']?'Desactivar':'Activar')?>"><i class="fa fa-power-off"></i></a>
									<a href="representantes.php?action=delete&id=<?=$rep['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar este representante?');"><span class="fa fa-trash-o"></span></a>
								</td>
						</tr>
<?						  }   ?>
				</tbody>
		</table>
<?				  }else{   ?>
		<p class="text-center">Aún no hay representantes</p>
<?				  }   ?>
