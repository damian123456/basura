<div class="sidebar sidebar-banners animate">
<?	if($banners){	?>
    <ul data-breakpoint="max-width: 650px">
<?		foreach($banners as $banner){
			if(!$banner['url_youtube']){
?>
        <li>
<?			if($banner['url']){	?>
			<a href="<?=$banner['url']?>" class="banner">
				<img class="banner" src="<?=foto_url($banner['archivo'],420,315, 95, 0)?>" alt="" />
			</a>
<?			}else{	?>
			<img class="banner" src="<?=foto_url($banner['archivo'],420,315, 95, 0)?>" alt="" />
<?			}	?>
		</li>
<?			}else{
			$pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
			$youtube_id = (preg_replace($pattern, '$1', $banner['url_youtube']));
?>
		<li>
			<iframe width="100%" height="205" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe>
		</li>
<?			}	?>
<?		}	?>
        <?/*<li><div class="video"><iframe width="420" height="315" src="//www.youtube.com/embed/e6kNohUuZkA" frameborder="0" allowfullscreen></iframe></div></li>*/?>
    </ul>
<?	}	?>
</div>
