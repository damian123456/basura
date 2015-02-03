        <div class="container container-slider container-slider-cursos">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="flexslider-cursos">
                        <ul class="slides">
                        <?$cursosSlideshow = $db->fetch_all('SELECT * FROM cursos_slideshow ORDER BY position, id DESC');
                        foreach ($cursosSlideshow as $cs) {
                            if ($cs['active'] == 1) {?>
                            <li>
                                <img src="uploads/<? echo $cs['image']?>" alt="">
                                <div class="container-caption-cursos">
                                    <div class="caption-cursos">
                                        <p><?echo $cs['title'];?></p>
                                        <div>
                                            <span class="ttl"><?echo $cs['subtitle'];?></span>
                                            <span class="sub-ttl"><?echo $cs['details'];?></span>
                                        </div>
                                        <a href="<?echo $cs['green_btn_url'];?>" target="_blank" class="btn btn-franquicias"><?echo $cs['green_btn_text'];?></a>
                                    </div>
                                </div>
                            </li>
                            <?}
                        }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>