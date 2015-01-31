<div class="center">
		<a href="representantes.php?action=new" class="btn-lg btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo representante</a>
</div>
<div class="separador">&nbsp;</div>
<?				  if($representantes){   ?>
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
<?						  foreach($representantes as $k => $representante){   ?>
						<tr id="representante_<?=$representante['id']?>">
								<td><?=$representante['nombre']?></td>
								<td><?=$representante['pais']?></td>
								<td><?=$representante['direccion']?></td>
								<td>
									<a href="representantes.php?action=edit&id=<?=$representante['id']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
									<a href="representantes.php?action=active&id=<?=$representante['id']?>" class="btn btn-<?=($representante['activo']?'success':'danger')?>" data-toggle="tooltip" title="<?=($representante['online']?'Desactivar':'Activar')?>"><i class="fa fa-power-off"></i></a>
									<a href="representantes.php?action=delete&id=<?=$representante['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar este representante?');"><span class="fa fa-trash-o"></span></a>
								</td>
						</tr>
<?						  }   ?>
				</tbody>
		</table>
<?				  }else{   ?>
		<p class="text-center">Aún no hay representantes</p>
<?				  }   ?>
