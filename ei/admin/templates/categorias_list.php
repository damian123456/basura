<?
	function imprimirSubcategorias($subcats, $level){
		if(count($subcats)==0) return;
		print '<ul class="sortable list-group categories_list">';
		$level++;
		foreach($subcats as $sc){
?>
			<li class="list-group-item cat_level_<?=$level?>" id="categoria_<?=$sc['id']?>" style="display:block;float:none">
				<span><span class="btn handle"><span class="glyphicon glyphicon-sort"></span></span> <?=$sc['nombre']?></span>
				<!--poner el no mostrar y el link-->
				<!--?=$sc['noMostrarEnMenu']?-->
				<span>
					<a href="categorias.php?action=edit&id=<?=$sc['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
					<a href="categorias.php?action=delete&id=<?=$sc['id']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar esta categoría?');"><span class="glyphicon glyphicon-trash"></span></a>
				</span>
				<?imprimirSubcategorias($sc['children'],$level);?>
			</li>
<?
		}
		print '</ul>';
	}
?>
	<div class="well row" style="margin-left:0;margin-right:0;background:#f0f0f0">
		<div class="form-horizontal col-sm-6">
			<label for="inputFilter" class="col-sm-2 control-label">Filtrar:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control input-sm" id="inputFilter" placeholder="Filtrar...">
			</div>
		</div>
		<div class="col-sm-6" style="text-align:right">
			<a href="categorias.php?action=new" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nueva Categoría</a>
		</div>
	</div>

	<div class="center">
	</div>
	<div class="separador">&nbsp;</div>
<?
	if($categorias){
		imprimirSubcategorias($categorias,0);
	} else {
?>
	<p class="text-center">No hay categorías.</p>
<?} ?>

<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).bind("mobileinit", function(){
		$.extend(  $.mobile , {
			ajaxEnabled: false,
			defaultPageTransition: 'none'
		});
	});
</script>
<script src="http://code.jquery.com/mobile/1.4.0-alpha.2/jquery.mobile-1.4.0-alpha.2.min.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("table").sieve({
			searchInput: $('#inputFilter')
		});

		// Return a helper with preserved width of cells
		var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		};

		$("ul.sortable").sortable({
			helper: fixHelper,
			update: function(event, ui) {
				var orden = $(this).sortable('toArray').toString();
				$.get('order.php', {orden:orden, order_general:'1'});
			},
			handle: ".handle",
			items: '> li'
		}).disableSelection();
	});
</script>
