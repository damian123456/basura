<?
include("includes/init.php");
    function print_children($children){
        if($children) { ?>
            <ul>
<?      foreach($children as $c){ ?>
                <li <?if($c['children']){?>class="submenu"<?}?>>
<?          if($c['id_course']){ ?>
                    <a href="<?=url(limpiarUrl($c['parent_name']).'/'.limpiarUrl($c['slug_category']).'/'.$c['id_course'].'-'.limpiarUrl($c['nombre']))?>"><?=$c['nombre']?></a>
<?          } else { ?>
                    <a href="#"><?=$c['nombre']?></a>
                    <?print_children($c['children'])?>
<?          } ?>
<?      } ?>
            </ul>
<?  }
    }

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

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="quienes-somos.php" class="btn-verde">Institucional</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn-verde-oscuro" data-toggle="dropdown" role="button" aria-expanded="false">Idiomas <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-verde-oscuro" role="menu">
                                    <li><a href="http://educaidiomas.com.ar/nuestros-cursos.php">Nuestros Cursos</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Horarios de los Cursos</a></li>
                                    <li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-portugues.php">Aprende Portugués</a></li>
									 <li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-ingles.php">Aprende Inglés</a></li>
									 <li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-italiano.php">Aprende Italiano</a></li>
									 <li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-frances.php">Aprende Francés</a></li>
									 <li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-aleman.php">Aprende Alemán</a></li>
									<li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-chino.php">Aprende Chino</a></li>
									<li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-japones.php">Aprende Japonés</a></li>
									<li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-ruso.php">Aprende Ruso</a></li>
									<li class="divider"></li>
                                    <li><a href="http://educaidiomas.com.ar/cursos-espanol.php">Aprende Español</a></li>
                                </ul>
                            </li>

                            <?/* ACA LAS TRAE:
                            foreach($cats as $c){ ?>
                                <li>
                                        <a href="#"><?=$c['nombre']?></a>
                                        <?print_children($c['children'])?>
                                </li>
<?                          }*/ ?>

                            <li><a href="cursos-online.php" class="btn-petroleo">Cursos Online</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn-magenta" data-toggle="dropdown" role="button" aria-expanded="false">Exámenes Internacionales <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-magenta" role="menu">
                                    <li><a href="examenes-celpe-bras.php">Celpe Bras</a></li>
                                    <li class="divider"></li>
                                    <li><a href="examenes-first-certificate.php">First Certificate</a></li>
                                    <li class="divider"></li>
                                    <li><a href="examenes-toefl.php">Toefl</a></li>
									<li class="divider"></li>
									<li><a href="examenes-italiano.php">CILS</a></li>
                                    <li class="divider"></li>
                                   	<li><a href="examenes-frances.php">DELF/DALF</a></li>
                                    <li class="divider"></li>
                                    <li><a href="examenes-goethe.php">Goethe-Institut</a></li>
                                    <li class="divider"></li>
									<li><a href="examenes-chino.php">HSK</a></li>
									<li class="divider"></li>
									<li><a href="examenes-japones.php">NŌKEN (JLPT)</a></li>
									 <li class="divider"></li>
                                    <li><a href="examenes-espanol.php">CELU</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn-violeta" data-toggle="dropdown" role="button" aria-expanded="false">Empresas <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-violeta" role="menu">
                                    <li><a href="empresas.php">Curso para Empresas</a></li>
                                    <li class="divider"></li>
                                    <li><a href="traducciones.php">Traducciones</a></li>
                                    <li class="divider"></li>
                                    <li><a href="interpretes.php">Intérpretes</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn-rojo" data-toggle="dropdown" role="button" aria-expanded="false">Servicios <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-rojo" role="menu">
                                    <li><a href="nivelacion.php">Nivelación</a></li>
                                    <li class="divider"></li>
                                    <li><a href="tutorias.php">Tutorías</a></li>
                                    <li class="divider"></li>
                                    <li><a href="cursos-colegios.php">Cursos para Colegios</a></li>
									<li class="divider"></li>
                                    <li><a href="cursos-universidades.php">Cursos para Universidades</a></li>
                                    <li class="divider"></li>
                                    <li><a href="apoyo-escolar.php">Clases de Apoyo Escolar</a></li>
                                    <li class="divider"></li>
									<li><a href="libreria-portada.php">Librería</a></li>
                                    <li class="divider"></li>
                                    <li><a href="biblioteca.php">Biblioteca</a></li>
                                </ul>
                            </li>
                            <li><a href="contacto.php" class="btn-naranja">Contacto</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>