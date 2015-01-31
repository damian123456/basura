<div class="course-modes">
<? foreach($item['variations'] as $v) if(count($v['properties']) > 0){ ?>
<div class="course-mode">
	<div class="course-mode-title">Curso online <?=$v['title']?></div>
	<div class="course-mode-body">
		<ul>
<?		foreach($v['properties'] as $p) { ?>
			<li><?=$p['value']?></li>
<?		} ?>
		</ul>
	</div>
</div>
<? } ?>
</div>
