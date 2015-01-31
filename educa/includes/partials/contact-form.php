<form class="form<?php echo !empty($formTemplate) ? ' ' . $formTemplate : NULL ?>" data-validator-auto="true" data-validator-ajax="true">
		<div class="form-group">
				<input class="form-control"  type="text" name="name" placeholder="Nombre y Apellido *" required>
		</div>
		<div class="form-group">
				<input class="form-control"  type="email" name="email" placeholder="Email *" required>
		</div>
		<div class="form-group">
				<input class="form-control"  type="text" name="phone" placeholder="Teléfono *" required>
		</div>
		<div class="form-group">
				<div class="form-select">
						<select class="form-control"  name="country">
								<option value="0" disabled selected>País:</option>
<?
							$paises = $db->fetch_all("SELECT * FROM Country ORDER BY name");
							foreach($paises as $p){
?>
								<option value="<?=$p['id']?>"><?=$p['Name']?></option>
<?						} ?>
						</select>
				</div>
		</div>
		<div class="form-group">
				<input class="form-control"  type="text" name="state" placeholder="Provincia / Estado:">
<!--
				<div class="form-select">
						<select class="form-control" name="state">
								<option value="0" disabled selected>Provincia / Estado:</option>
						</select>
				</div>
-->
		</div>
		<div class="form-group form-group-multiple">
				<div class="input">
						<input class="form-control"  type="text" name="city" placeholder="Ciudad:">
				</div>
				<div class="input">
						<input class="form-control"  type="text" name="zip" placeholder="Código postal:">
				</div>
		</div>
		<div class="form-group">
				<div class="form-select">
						<select class="form-control"  name="language">
								<option value="0" disabled selected>Idioma:</option>
<?
								$subcats = $db->fetch_all("
										SELECT cat.id, cat.nombre
										FROM categorias AS cat
										WHERE cat.parent > 0
										ORDER BY cat.orden
								");
								if($subcats) foreach($subcats as $s){
?>
								<option value="<?=$s['id']?>"><?=$s['nombre']?></option>
<?
								}
?>
						</select>
				</div>
		</div>
		<div class="form-group">
				<textarea class="form-control"  name="message" placeholder="Comentarios:"></textarea>
		</div>
		<div class="form-actions">
				<button class="btn btn-default btn-red" name="contact" type="submit">Enviar mensaje</button>
		</div>
		<input type="hidden" name="form_type" value="contact_form">
</form>
