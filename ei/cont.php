<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Educa Idiomas, cursos de idiomas para empresas en Mar del Plata</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Asap:400,400italic,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style2.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>

        <link rel="apple-touch-icon" href="images/favicon.png"/>
        <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/respond.min.js"></script>
          <script src="js/html5.js"></script>
        <![endif]-->

    </head>
    <body>
        <div id="preloader"></div>
        <?php include("inc-header.php"); ?>

        <div class="content-page">
            <img src="img/firulete-empresas1.png" alt="" class="firulete-empresas1">
            <img src="img/firulete-empresas2.png" alt="" class="firulete-empresas2">
            <img src="img/firulete-empresas3.png" alt="" class="firulete-empresas3">
        </div>
        <div class="container container-slider container-slider-empresas">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <!--SLIDER EMPRESAS-->
                    <div class="flexslider-empresas">
                    <?if ($empresas){
                        include("slider-empresas.php");
                    }?>
                    </div>
                    <!--FIN SLIDER EMPRESAS-->
                </div>
            </div>
        </div>
        <div class="container">    
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <?$conten = $db->fetch_all('SELECT * FROM courses WHERE id = {$id_item}');
                foreach ($conten as $con) {?>
                    <h1 class="titulo-seccion-tn">Cursos para Empresas</h1>
                    <p class="bajada-tn">Consciente de la importancia de apoyar el desarrollo de la relaciones entre los mercados económicos, el INSTITUTO EDUCA  IDIOMAS realiza cursos especializados de enseñanza y capacitación en idiomas, destinados a empleados y funcionarios de empresas nacionales e internacionales.
                    Todos los cursos presenciales están a cargo de profesores universitarios dedicados a la enseñanza de una lengua extranjera y son  evaluados y supervisados por nuestra coordinación para obtener y garantizar los mejores resultados. Tanto los días y horarios como el lugar físico donde se realizará,  se elegirá en conjunto con el grupo empresarial o el área de recursos humanos a cargo, priorizando la disponibilidad y flexibilidad de los alumnos. </p> 
                    <p class="bajada-tn">Aquellos que no puedan venir a estudiar en las sedes, podrán tomar los cursos de manera virtual o bien, recibir la capacitación en su lugar de trabajo. Nuestro equipo docente se adaptará a la modalidad que prefieran.
                    Resaltamos la palabra “especializados” cuando definimos a este tipo de cursos, porque son flexibles y están orientados a satisfacer las exigencias particulares de cada empresa interesada, a grupos de trabajo y/o de manera personalizada e individual.  </p>
                    <p class="bajada-tn">Es decir, en otras palabras, que trabajamos para responder directamente a su necesidad de vocabulario, contenido y nivel comunicativo en el área de negocios, comercio exterior, industria, entre otros, para que alcancen el nivel deseado, aprobado a través de un examen internacional.</p>
                    <?}?><!--<p class="bajada-tn bajada-tn-bold">Para ello ofrecemos:</p>-->
                    
                    <!--TABLAS DE COLORES

                    <div class="box">
                        <b>Cursos Regulares:</b> Encuentros de 120min. semanales pensados para desarrollar la producción oral y escrita de manera tal, que los alumnos se comuniquen libremente y utilicen el idioma adquirido siempre que lo necesiten y de acuerdo a su necesidad, en negocios, asuntos laborales, profesionales y en lo cotidiano.
                    </div>
                    <div class="box petroleo">
                        <b>Cursos Intensivos:</b> Según la necesidad específica del grupo, en estos cursos se intensifica la carga horaria semanal para profundizar los conocimientos y aumentar el nivel de comunicación, rápidamente.
                    </div>
                    <div class="box naranja">
                        <b>Cursos de Conversación con nativo-hablantes:</b> Cursos pensados sobre el uso de vocabulario específico, temáticos, creativos, sin una exigencia en la producción escrita y gramatical, para ejercitar todo el conocimiento, mejorar la comunicación, lograr fluidez en el ámbito laboral,  y que el alumno pueda estar seguro al defender su palabra interactuando con sus colegas y el docente. 
                    </div>
                    <div class="box magenta">
                        <b>Cursos de Idiomas Online:</b> Cursos brindados a funcionarios de empresas, que por falta de disponibilidad de horarios y demasiados compromisos laborales no pueden tomar cursos en un horario establecido. Para que organicen su tiempo de estudio como prefieran y donde gusten, Educa Idiomas les alcanza, dentro de todo el territorio nacional, cursos para aprender de manera virtual, con un seguimiento tutorial personalizado y un foro de consultas las 24hs.
Conózcalos a través de nuestro sitio <a href="http://www.educaidiomasonline.com" target="blank">www.educaidiomasonline.com</a>
                    </div>
                    <div class="box azul">
                        <p>Nuestros servicios:</p>
                        <ul>
                            <li>Cursos individuales o grupales</li>
                            <li>Horarios flexibles</li>
                            <li>Profesores universitarios y nativos</li>
                            <li>Cursos diseñados para responder a las necesidades específicas de     cada empresa.</li>
                            <li>Cursos en todos los idiomas en la compañía, instituto u online, a través de nuestra plataforma virtual.</li>
                            <li>Exámenes de nivelación</li>
                            <li>Acompañamiento empresarial, excursiones, desayunos ejecutivos</li>
                        </ul>
                    </div>

                    <!--FIN TABLAS DE COLORES-->

                    <!--<p class="text-bold">Junto al área de recursos humanos de su empresa, pensaremos el curso de enseñanza y aprendizaje del idioma que mejor se adapte a ustedes! 
                        Las siguientes empresas cuentan el servicio educativo del INSTITUTO EDUCA IDIOMAS para su capacitación y aprendizaje de idiomas:<br><br>

                        GOLDEN FRUIT S.A.<br>
                        MC CAIN ARGENTINA S.A.<br>
                        MATERIA HNOS. S.A.C.I.F.<br>
                        BIORENA<br>
                        PROMAQ<br>
                        DELSAT<br>
                        ADVANTA<br>
                        MEDWARE<br>
                        COOMARPES<br>
                        CITEC<br>
                        QUILMES<br>
                        CMS (CREDIT MANAGEMENT SOLUTION)</p>-->
                </div>
                <!--<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="foto-empresas foto-empresas-top">
                        <img src="img/empresas1.jpg" alt="">
                    </div>
                    <div class="foto-empresas">
                        <img src="img/empresas2.jpg" alt="">
                    </div>
                    <div class="foto-empresas">
                        <img src="img/empresas3.jpg" alt="">
                    </div>
                    <div class="foto-empresas">
                        <img src="img/empresas4.jpg" alt="">
                    </div>
                </div>-->
            </div>
			<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="contacto.php" class="btn btn-franquicias in-tablas">SU CONSULTA NOS INTERESA</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php include("inc-banderas.php"); ?>
                </div>
            </div>
        </div>
        <?php include("inc-footer.php"); ?>
    </body>
</html>
