	<?
	// Hack momentaneo, Flor necesita mostrarlo ahora
	if($item){
		$categoria = $db->fetch_item("SELECT * FROM categorias WHERE id = {$item['id_category']}");

		$subcats = $db->fetch_all("
			SELECT *, '{$categoria['nombre']}' AS categoria_nombre
			FROM courses
			WHERE id_category = {$item['id_category']}
			AND id = {$item['id']}
		");
	} else {
		$subcats = $db->fetch_all("
			SELECT c.*, cat.orden AS orden_cat, cat.nombre AS categoria_nombre
			FROM courses AS c
			LEFT JOIN categorias AS cat
				ON cat.id = c.id_category
			ORDER BY cat.parent, cat.orden, c.position
		");
	}
?>
<form method="post" class="form" data-validator-auto="true" data-validator-ajax="true">
		<div class="form-group">
				<input class="form-control" type="text" name="name" placeholder="Nombre y Apellido *" required>
		</div>
		<div class="form-group">
				<input class="form-control" type="email" name="email" placeholder="Email *" required>
		</div>
		<div class="form-group form-group-multiple">
				<div class="input">
						<input class="form-control" type="text" name="phone" placeholder="Teléfono *" required>
				</div>
				<div class="input">
						<input class="form-control" type="text" name="age" placeholder="Edad:">
				</div>
		</div>
		<div class="form-group">
				<div class="form-select">
						<select class="form-control" name="country">
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
						<input class="form-control" type="text" name="city" placeholder="Ciudad:">
				</div>
				<div class="input">
						<input class="form-control" type="text" name="zip" placeholder="Código postal:">
				</div>
		</div>
		<div class="form-group">
				<div class="form-select">
						<select class="form-control" id="select_course_form" name="course">
								<option value="0" disabled selected>Curso elegido:</option>
<?
								$show_payment = false;
								if($subcats) foreach($subcats as $s){
									$modalidades = $db->fetch_all("
										SELECT cv.*, COUNT(cvi.id_variation) AS cant_items
										FROM courses_variations AS cv
										LEFT JOIN courses_variations_items AS cvi
											ON cvi.id_variation=cv.id
										WHERE cv.id_course = {$s['id']}
										GROUP BY cv.id
									");
									
									if($modalidades) foreach($modalidades as $m) if( $m['cant_items'] > 0 ){
										if($m['available']) $show_payment = true;
?>
								<option value="<?=$s['id'].'|'.$m['id']?>" data-type="<?=($m['title']=="Auto-Evaluativo"?'mode-auto':'mode-live')?>" <?/*if($item && $item['id']==$s['id']){?>selected<?}*/?>><?=$s['categoria_nombre']?> - <?=$s['title']?> - <?=$m['title']?><?if(!$m['available']){?> (Pr&oacute;ximamente)<?}?></option>
<?
									}
								}
?>
						</select>
				</div>
		</div>
		<div <?if(!$show_payment){?>style="display:none"<?}?> class="form-group">
				<div class="form-select">
						<select class="form-control" id="select_payment_method" name="payment">
								<option value="0" disabled selected>Forma de pago:</option>
								<option value="1">Curso completo</option>
								<option value="2">Pago mensual</option>
						</select>
				</div>
		</div>
		<div class="form-group">
				<textarea class="form-control" name="message" placeholder="Comentarios:"></textarea>
		</div>
		<div class="form-actions">
				<button class="btn btn-default btn-red" name="register" type="submit">Enviar mensaje</button>
		</div>
		<input type="hidden" name="form_type" value="register_form">
</form>
