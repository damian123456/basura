                       <?

                       /* CAMPOS DE CADA FILA */
                       
                       //ARRAYS PREDEFINIDOS
                       $camps = array("col1f1","col2f1","col3f1","col3f2","content","excerpt","col1f1f2","col2f1f2","col3f1f2","col3f2f2","contentf2","excerptf2",
                        "col1f1f3","col2f1f3","col3f1f3","col3f2f3","contentf3","excerptf3","col1f1f4","col2f1f4","col3f1f4","col3f2f4","contentf4","excerptf4",
                        "col1f1f5","col2f1f5","col3f1f5","col3f2f5","contentf5","excerptf5","col1f1f6","col2f1f6","col3f1f6","col3f2f6","contentf6","excerptf6");

                       $camp1="col1f1";
                       $camp2="col2f1";
                       $camp3="col3f1";
                       $camp4="col3f2";
                       $camp5="content";
                       $camp6="excerpt";

                         foreach($tbl as $c){  ?>
                            <div role="tabpanel"  class="tab-pane fade <? if ($default == $c['title']) echo 'in active'?>" id="<?echo $c['title']?>">
                                <?/* FILAS */?>
                                <?
                                for ($i=0; $i < 5; $i++) { 
                                    
                                
                                ?>
                                <?if(!empty($c[$camps[$i]])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camps[0+6]])){?>
                                    <div class="col-1"><?echo $c[$camps[0+6]]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camps[1+6]])){?>
                                    <div class="col-2"><?echo $c[$camps[1]]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camps[2]]) && empty($c[$camps[4]])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camps[2]]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camps[4]])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camps[2]]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camps[4]]?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camps[3]]) && empty($c[$camps[5]])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camps[3]]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camps[5]])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$$camps[3]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camps[5]]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}//DEL IF?>
                                <?}//DEL FOR?>
                                <?/* FIN FILAS */?>
                            </div>
                                <?}?>