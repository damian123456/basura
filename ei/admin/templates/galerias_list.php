	<div class="text-right">
		<a href="galerias.php?action=new" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>  Añadir Galería</a>
		
	</div>
	<div style="clear:both"></div>
	<div class="separador">&nbsp;</div>
	<div class="panel panel-default">
	  <!-- Default panel contents -->
		<div class="panel-heading"><!--strong>Galerías</strong--></div>
		<div class="panel-body" style="background:#f9f9f9">
			<h3>Categoría General</h3>
<?			if($galerias0){?>				
				<ul id="sortable" class="row sortable" class="row" style="list-style:none;margin:0;padding:0">
					<?foreach($galerias0 as $k => $galeria){ ?>		
						<li id="galeria_<?=$galeria['id']?>" class="col-sm-3 galeria">
						<div class="thumbnail">
						<?php $foto = $db->fetch_all("SELECT archivo FROM galerias_contenido where id_galeria=".$galeria['id']." and archivo<>'' order by archivo+0, archivo"); 
						      if($foto[0]['archivo']==''){
							     $foto = $db->fetch_all("SELECT url_youtube FROM galerias_contenido where id_galeria=".$galeria['id']);
							     $cod = explode('=',$foto[0]['url_youtube']);
								 echo "<img src='http://img.youtube.com/vi/".$cod[1]."/0.jpg' class='img-responsive' alt='...'>";
							  }
							  else {
							  	$url = url("uploads/galerias/".$galeria['id']."/thumbnail/".$foto[0]['archivo']);
								echo "<img src='".$url."' class='img-responsive' alt='...'>";
							  }
							?>
							<div class="caption">
								<hr />
								<p class="text-center"><?=$galeria['nombre']?></p>
								<hr />
								<p class="text-center">
									<a href="galerias.php?action=view&id_galeria=<?=$galeria['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a>
									<a href="galerias.php?action=edit&id_galeria=<?=$galeria['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
									<a href="galerias.php?action=delete&id_galeria=<?=$galeria['id']?>" class="btn btn-default" onClick="return confirm('¿Seguro que desea eliminar esta galeria?');"><span class="glyphicon glyphicon-trash"></span></a>
								</p>
							</div>
						</div>
						</li>
				<?} ?>
				</ul>
<?			}else{ ?>
			<p class="text-center">No hay galerías</p>
<?			} ?>
		</div>
		<div class="panel-body" style="background:#f9f9f9">
			<h3>Categoría Prensa</h3>
<?			if($galerias1){?>				
				<ul id="sortable" class="row sortable" style="list-style:none;margin:0;padding:0">
					<?foreach($galerias1 as $k => $galeria){ ?>		
						<li id="galeria_<?=$galeria['id']?>" class="col-sm-3 galeria">
						<div class="thumbnail">
							<?php $foto = $db->fetch_all("SELECT archivo FROM galerias_contenido where id_galeria=".$galeria['id']." and archivo<>'' order by archivo+0, archivo"); 
						      if($foto[0]['archivo']==''){
							     $foto = $db->fetch_all("SELECT url_youtube FROM galerias_contenido where id_galeria=".$galeria['id']);
							     $cod = explode('=',$foto[0]['url_youtube']);
								 echo "<img src='http://img.youtube.com/vi/".$cod[1]."/0.jpg' class='img-responsive' alt='...'>";
							  }
							  else {
							  	$url = url("uploads/galerias/".$galeria['id']."/thumbnail/".$foto[0]['archivo']);
								echo "<img src='".$url."' class='img-responsive' alt='...'>";
							  }
							?>
							<div class="caption">
								<hr />
								<p class="text-center"><?=$galeria['nombre']?></p>
								<hr />
								<p class="text-center">
									<a href="galerias.php?action=view&id_galeria=<?=$galeria['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a>
									<a href="galerias.php?action=edit&id_galeria=<?=$galeria['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
									<a href="galerias.php?action=delete&id_galeria=<?=$galeria['id']?>" class="btn btn-default" onClick="return confirm('¿Seguro que desea eliminar esta galeria?');"><span class="glyphicon glyphicon-trash"></span></a>
								</p>
							</div>
						</div>
						</li>
				<?} ?>
				</ul>
<?			}else{ ?>
			<p class="text-center">No hay galerías</p>
<?			} ?>
		</div>
		<div class="panel-body" style="background:#f9f9f9">
			<h3>Categoría Viajes Culturales</h3>
<?			if($galerias2){?>				
				<ul id="sortable" class="row sortable" class="row" style="list-style:none;margin:0;padding:0">
					<?foreach($galerias2 as $k => $galeria){ ?>		
						<li id="galeria_<?=$galeria['id']?>" class="col-sm-3 galeria">
						<div class="thumbnail">
							<?php $foto = $db->fetch_all("SELECT archivo FROM galerias_contenido where id_galeria=".$galeria['id']." and archivo<>'' order by archivo+0, archivo"); 
						      if($foto[0]['archivo']==''){
							     $foto = $db->fetch_all("SELECT url_youtube FROM galerias_contenido where id_galeria=".$galeria['id']);
							     $cod = explode('=',$foto[0]['url_youtube']);
								 echo "<img src='http://img.youtube.com/vi/".$cod[1]."/0.jpg' class='img-responsive' alt='...'>";
							  }
							  else {
							  	$url = url("uploads/galerias/".$galeria['id']."/thumbnail/".$foto[0]['archivo']);
								echo "<img src='".$url."' class='img-responsive' alt='...'>";
							  }
							?>
							<div class="caption">
								<hr />
								<p class="text-center"><?=$galeria['nombre']?></p>
								<hr />
								<p class="text-center">
									<a href="galerias.php?action=view&id_galeria=<?=$galeria['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a>
									<a href="galerias.php?action=edit&id_galeria=<?=$galeria['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
									<a href="galerias.php?action=delete&id_galeria=<?=$galeria['id']?>" class="btn btn-default" onClick="return confirm('¿Seguro que desea eliminar esta galeria?');"><span class="glyphicon glyphicon-trash"></span></a>
								</p>
							</div>
						</div>
						</li>
				<?} ?>
				</ul>
<?			}else{ ?>
			<p class="text-center">No hay galerías</p>
<?			} ?>
		</div>
	</div>
