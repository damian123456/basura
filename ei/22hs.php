<div class="flexslider">
                        <ul class="slides">
                        <?$homeSlideshow = $db->fetch_all('SELECT * FROM home_slideshow ORDER BY position, id DESC');
                        foreach ($homeSlideshow as $hs) {
                            if ($hs['active'] == 1) {?>
						<li>
   						    <img src="uploads/<? echo $hs['image']?>" alt="">
                                <a href="<?echo $hs['green_btn_url']?>" target="_blank">
                                    <div class="container-caption">
                                        <img src="img/anotate.png" alt="" class="point">
                                        <div class="caption">
                                            <p><?echo $hs['title']?></p>
                                            <span><?echo $hs['subtitle']?></span>
                                        </div>
                                    </div>
                                </a>
                        </li>
                            <?}
                        }?>
                        </ul>
</div>