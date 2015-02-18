<?
include("includes/init.php");
    function print_children($children){
        if($children) { ?>
            
<?      foreach($children as $c){ 

            if ($c['parent'] == 14 && $c['id'] != 72) {
?>
                <li><a href="<?=$c['link']?>"><?=$c['nombre']?></a></li>
<?               
            }else{
?>
                <li><a href="2content.php?content=<?=$c['id']?>&category=<?=$c['parent']?>"><?=$c['nombre']?></a></li>
<?  
            }
?>
                
                    
                    
<?          } ?>
<?      } ?>
            
<?  }
    

    $tmp_cats = $db->fetch_all("SELECT * FROM categorias ORDER BY parent, orden, id");
    if(is_array($tmp_cats)) {
        $cats = $tmp_cats;
        foreach($tmp_cats as $c){
            $tmp = $db->fetch_all("
                SELECT c.id AS id_course,c.title AS nombre, c.id_category AS parent, c2.nombre AS parent_name, cat.nombre AS slug_category FROM courses AS c
                    JOIN categorias AS cat
                        ON cat.id = c.id_category
                    LEFT JOIN categorias AS c2
                        ON c2.id = cat.parent
                WHERE c.id_category={$c['id']}
                ORDER BY position, nombre
            ");
            if(is_array($tmp)) $cats = array_merge($cats, $tmp);
        }
    }
    $cats = build_tree($cats);
?>
 <header>
            <nav class="navbar navbar-default navbar-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="index.php"><img src="img/logo.png" class="logo" alt=""></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
						 <li><a href="index.php">Inicio</a></li>
                            <li><a href="agenda.php">Agenda</a></li>
                            <li><a href="galeria.php">Galeria</a></li>
                            <li><a href="libreria-portada.php">Librería</a></li>
                            <li><a href="franquicias.php">Franquicia</a></li>
                            <li class="inline-socials"><a href="https://www.facebook.com/educaidiomas.instituto" class="facebook" target="blank"></a></li>
                            <li class="inline-socials"><a href="https://twitter.com/EducaIdiomasOK" class="twitter" target="blank"></a></li>
                            <li class="inline-socials"><a href="https://www.youtube.com/channel/UCNkRqoAXCunUops_0LBMJAQ" class="youtube" target="blank"></a></li>
                            <li class="inline-socials"><a href="https://plus.google.com/105189137727266038039" class="google" target="blank"></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
            <nav class="navbar navbar-default navbar-bottom" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>

                    <!--MENU:-->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav navbar-right">

                        <!--PATRON DE COLORES DE LOS BOTONES -->
                        <? $cols = array("btn-verde", "btn-verde-oscuro", "btn-petroleo","btn-magenta", "btn-violeta", "btn-rojo", "btn-naranja");
                            $cols_drop = array("dropdown-verde", "dropdown-verde-oscuro", "dropdown-petroleo","dropdown-magenta", "dropdown-violeta", "dropdown-rojo", "dropdown-naranja"); 
                           $recorrido = 0;?>

                        
                        <?foreach($cats as $c){?>
                            <?if (!empty($c['children'])) {?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle <?echo $cols[$recorrido];?>" data-toggle="dropdown" role="button" aria-expanded="false"><?=$c['nombre']?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu <?echo $cols_drop[$recorrido];?>" role="menu">
                                        <?print_children($c['children'])?>
                                        
                                                                      
                                        <li class="divider"></li>
                                    </ul>
                                </li>
                            <?}else{?>
                                <li><a href="<?=$c['link']?>" class="<?echo $cols[$recorrido];?>"><?=$c['nombre']?></a></li>
                                <?}
                                $recorrido++;?>
                            <?} /*FIN FOREACH*/ ?>
                        </ul>                       
                    </div><!-- /.navbar-collapse -->
                    <!--FIN  MENU-->
                </div><!-- /.container-fluid -->
            </nav>
        </header>