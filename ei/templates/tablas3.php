






                                                       <?

                       /* CAMPOS DE CADA FILA */
                       

                       $camp1="col1f1";
                       $camp2="col2f1";
                       $camp3="col3f1";
                       $camp4="col3f2";
                       $camp5="content";
                       $camp6="excerpt";

                         foreach($tbl as $c){  ?>
                            <div role="tabpanel"  class="tab-pane fade <? if ($default == $c['title']) echo 'in active'?>" id="<?echo $c['title']?>">

                                <?/* FILA 1 */?>
                                <?if(!empty($c[$camp1])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camp1])){?>
                                    <div class="col-1"><?echo $c[$camp1]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camp2])){?>
                                    <div class="col-2"><?echo $c[$camp2]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp3]) && empty($c[$camp5])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camp3]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp5])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp3]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['content']?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp4]) && empty($c[$camp6])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp4]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp6])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp4]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp6]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 1 */?>

                                <?/* FILA 2 */?>
                                <?if(!empty($c['col1f1f2'])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c['col1f1f2'])){?>
                                    <div class="col-1"><?echo $c['col1f1f2']?></div>
                                    <?}?>
                                    <div class="col-2"><?echo $c['col2f1f2']?></div>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <a class="col-top" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f1f2']?></a>
                                            <?if(!empty($c['contentf2'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['contentf2']?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c['col3f2f2'])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f2f2']?></a>
                                            <?}?>
                                            <?if(!empty($c['excerptf2'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['excerptf2']?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 2 */?>

                                <?/* FILA 3 */?>
                                <?if(!empty($c['col1f1f3'])){?>
                                <div class="tabla-curso">
                                    <div class="col-1"><?echo $c['col1f1f3']?></div>
                                    <div class="col-2"><?echo $c['col2f1f3']?></div>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <a class="col-top" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f1f3']?></a>
                                            <?if(!empty($c['contentf3'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['contentf3']?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c['col3f2f3'])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f2f3']?></a>
                                            <?}?>
                                            <?if(!empty($c['excerptf3'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['excerptf3']?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 3 */?> 

                                <?/* FILA 4 OPCIONAL */?> 
                                <?if(!empty($c['col1f1f4'])){?>
                                <div class="tabla-curso">
                                    <div class="col-1"><?echo $c['col1f1f4']?></div>
                                    <div class="col-2"><?echo $c['col2f1f4']?></div>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <a class="col-top" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f1f4']?></a>
                                            <?if(!empty($c['contentf4'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['contentf4']?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c['col3f2f4'])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f2f4']?></a>
                                            <?}?>
                                            <?if(!empty($c['excerptf4'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['excerptf4']?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 4 */?>

                                <?/* FILA 5 OPCIONAL */?> 
                                <?if(!empty($c['col1f1f5'])){?>
                                <div class="tabla-curso">
                                    <div class="col-1"><?echo $c['col1f1f5']?></div>
                                    <div class="col-2"><?echo $c['col2f1f5']?></div>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <a class="col-top" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f1f5']?></a>
                                            <?if(!empty($c['contentf5'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['contentf5']?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c['col3f2f5'])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f2f5']?></a>
                                            <?}?>
                                            <?if(!empty($c['excerptf5'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['excerptf5']?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 5 */?>


                                <?/* FILA 6 OPCIONAL */?> 
                                <?if(!empty($c['col1f1f6'])){?>
                                <div class="tabla-curso">
                                    <div class="col-1"><?echo $c['col1f1f6']?></div>
                                    <div class="col-2"><?echo $c['col2f1f6']?></div>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <a class="col-top" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f1f6']?></a>
                                            <?if(!empty($c['contentf6'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['contentf6']?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c['col3f2f6'])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c['col3f2f6']?></a>
                                            <?}?>
                                            <?if(!empty($c['excerptf6'])){?>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c['excerptf6']?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 6 */?>
                            </div>
                                <?}?>