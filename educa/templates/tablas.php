                       <?

                       

                       /* CAMPOS DE CADA FILA */
                       

                       $camp1="col1f1";
                       $camp2="col2f1";
                       $camp3="col3f1";
                       $camp4="col3f2";
                       $camp5="content";
                       $camp6="excerpt";

                       $camp12="col1f1f2";
                       $camp22="col2f1f2";
                       $camp32="col3f1f2";
                       $camp42="col3f2f2";
                       $camp52="contentf2";
                       $camp62="excerptf2";

                       $camp13="col1f1f3";
                       $camp23="col2f1f3";
                       $camp33="col3f1f3";
                       $camp43="col3f2f3";
                       $camp53="contentf3";
                       $camp63="excerptf3";

                       $camp14="col1f1f4";
                       $camp24="col2f1f4";
                       $camp34="col3f1f4";
                       $camp44="col3f2f4";
                       $camp54="contentf4";
                       $camp64="excerptf4";

                       $camp15="col1f1f5";
                       $camp25="col2f1f5";
                       $camp35="col3f1f5";
                       $camp45="col3f2f5";
                       $camp55="contentf5";
                       $camp65="excerptf5";

                       $camp16="col1f1f6";
                       $camp26="col2f1f6";
                       $camp36="col3f1f6";
                       $camp46="col3f2f6";
                       $camp56="contentf6";
                       $camp66="excerptf6";

                       $camp17="col1f1f7";
                       $camp27="col2f1f7";
                       $camp37="col3f1f7";
                       $camp47="col3f2f7";
                       $camp57="contentf7";
                       $camp67="excerptf7";

                       $camp18="col1f1f8";
                       $camp28="col2f1f8";
                       $camp38="col3f1f8";
                       $camp48="col3f2f8";
                       $camp58="contentf8";
                       $camp68="excerptf8";

                         foreach($tbl as $c){?>
                            <div role="tabpanel"  class="tab-pane fade <? if ($default == $c['title']) echo 'in active'?>" id="<?echo str_replace(' ', '-', $c['title'])?>">

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
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp5]?></ul>
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
                                <?if(!empty($c[$camp12])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camp12])){?>
                                    <div class="col-1"><?echo $c[$camp12]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camp22])){?>
                                    <div class="col-2"><?echo $c[$camp22]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp32]) && empty($c[$camp52])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camp32]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp52])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp32]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp52]?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp42]) && empty($c[$camp62])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp42]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp62])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp42]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp62]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 2 */?>

                                <?/* FILA 3 */?>
                                <?if(!empty($c[$camp13])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camp13])){?>
                                    <div class="col-1"><?echo $c[$camp13]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camp23])){?>
                                    <div class="col-2"><?echo $c[$camp23]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp33]) && empty($c[$camp53])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camp33]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp53])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp33]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp53]?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp43]) && empty($c[$camp63])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp43]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp63])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp43]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp63]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 3 */?>

                                <?/* FILA 4 */?>
                                <?if(!empty($c[$camp14])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camp14])){?>
                                    <div class="col-1"><?echo $c[$camp14]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camp24])){?>
                                    <div class="col-2"><?echo $c[$camp24]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp34]) && empty($c[$camp54])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camp34]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp54])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp34]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp54]?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp44]) && empty($c[$camp64])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp44]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp64])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp44]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp64]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 4 */?>

                                <?/* FILA 5 */?>
                                <?if(!empty($c[$camp15])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camp15])){?>
                                    <div class="col-1"><?echo $c[$camp15]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camp25])){?>
                                    <div class="col-2"><?echo $c[$camp25]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp35]) && empty($c[$camp55])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camp35]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp55])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp35]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp55]?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp45]) && empty($c[$camp65])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp45]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp65])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp45]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp65]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 5 */?>

                                <?/* FILA 6 */?>
                                <?if(!empty($c[$camp16])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camp16])){?>
                                    <div class="col-1"><?echo $c[$camp16]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camp26])){?>
                                    <div class="col-2"><?echo $c[$camp26]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp36]) && empty($c[$camp56])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camp36]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp56])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp36]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp56]?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp46]) && empty($c[$camp66])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp46]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp66])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp46]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp66]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 6 */?>

                                <?/* FILA 7 */?>
                                <?if(!empty($c[$camp17])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camp17])){?>
                                    <div class="col-1"><?echo $c[$camp17]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camp27])){?>
                                    <div class="col-2"><?echo $c[$camp27]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp37]) && empty($c[$camp57])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camp37]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp57])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp37]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp57]?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp47]) && empty($c[$camp67])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp47]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp67])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp47]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp67]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 7 */?>

                                <?/* FILA 8 */?>
                                <?if(!empty($c[$camp18])){?>
                                <div class="tabla-curso">
                                    <?if(!empty($c[$camp18])){?>
                                    <div class="col-1"><?echo $c[$camp18]?></div>
                                    <?}?>
                                    <?if(!empty($c[$camp28])){?>
                                    <div class="col-2"><?echo $c[$camp28]?></div>
                                    <?}?>
                                    <div class="col-3">
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp38]) && empty($c[$camp58])){ /* ABAJO: la class css conchi tiene el "+ INFO" */?>
                                            <ul class="col-top"><?echo $c[$camp38]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp58])){?>
                                            <a class="col-top conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp38]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp58]?></ul>
                                            <?}?>
                                        </div>
                                        <div class="dropdown">
                                            <?if(!empty($c[$camp48]) && empty($c[$camp68])){?>
                                            <a class="col-bottom" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp48]?></a>
                                            <?}?>
                                            <?if(!empty($c[$camp68])){?>
                                            <a class="col-bottom conchi" href="javascript:;" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"><?echo $c[$camp48]?></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><?echo $c[$camp68]?></ul>
                                            <?}?>
                                        </div>
                                    </div>                                    
                                </div>
                                <?}?>
                                <?/* FIN FILA 8 */?>

                            </div>
                                <?}?>