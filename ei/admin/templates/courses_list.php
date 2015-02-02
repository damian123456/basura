<?
/* remplace course | curso */
	function imprimirSubcategorias($subcats, $level){
		if(count($subcats)==0) return;

		print '<ul class="sortable list-group categories_list level_'.$level.'">';
		$level++;
		foreach($subcats as $sc){
?>
			<li class="list-group-item cat_level_<?=$level?> <?=$sc['id_course']?'sortthis':''?>" <?=$sc['id_course']?'id="course_'.$sc['id'].'"':''?> style="display:block;float:none">

<?		if($sc['id_course']){ ?>
				<span><span class="btn handle"><span class="glyphicon glyphicon-sort"></span></span> <?=$sc['nombre']?></span>
				<span>
					<a href="../courses.php?id=<?=$sc['id_course']?>" class="btn btn-primary" target="_blank"><span class="fa fa-globe"></span></a>
					<a href="courses.php?action=edit&id=<?=$sc['id_course']?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span></a>
					<a href="courses.php?action=delete&id=<?=$sc['id_course']?>" class="btn btn-danger" onClick="return confirm('¿Seguro que desea eliminar este contenido?');"><span class="glyphicon glyphicon-trash"></span></a>
				</span>
<?		} else { ?>
				<span><?=$sc['nombre']?></span>
				<?imprimirSubcategorias($sc['children'],$level);?>
<?		} ?>
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
		<a href="courses.php?action=new" class="btn btn-primary"><i class="fa fa-plus"></i>  Añadir contenido</a>
	</div>
</div>
<div class="separador">&nbsp;</div>
<?
	if(count($items)){
		imprimirSubcategorias($items,0);
	} else { ?>
	<p class="text-center">No hay contenido</p>
<? } ?>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("table").sieve({
			searchInput: $('#inputFilter')
		});
	});
</script>
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
		$("ul.sortable.level_0").sieve({
			searchInput: $('#inputFilter'),
			itemSelector: "li"
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
			items: '> li.sortthis'
		}).disableSelection();
	});
</script>
