<?php
function data($request){
	switch ($request){
		// COMPANY DATA
		case "company":
			return "EducaIdiomas Online";
		break;
		case "domain":
			return "educaidiomasonline.com"; // Sin "http://www." ni barra final => Ej: "midominio.com"
		break;
		case "email":
			return "cursos@educaidiomasonline.com";
		break;
		//WEBMASTER DATA
		case "webmaster":
			return "Conceptovisual";
		break;
		case "webmaster-email":
			return "hola@conceptovisualweb.com";
		break;
		case "webmaster-domain":
			return "conceptovisualweb.com";
		break;
		//VARIOS
		case "hash":
			return "radioactive";
		break;
		default:
			return "error";
	}
}//require_once($_SERVER['DOCUMENT_ROOT']."/includes/functions/data.php");
$config = array();
if(!empty($_POST["scope"])) $scope = $_POST["scope"];
else $scope = $_GET["scope"];
//Configuraciones generales
$config["scope"] = array(


	/* TABLA CURSOS */

	"tbl_cursos" => array(
	"current" => 1,
	"nombre" => "Tabla Cursos",
	"link" => "tbl_cursos.php",
	"submenu" => array(
			array(
				"link" => "tbl_cursos.php",
				"nombre" => "Lista"
			),
			array(
				"link" => "tbl_cursos.php?action=new",
				"nombre" => "Agregar"
			)
		)
	),

	/* FIN TABLA CURSOS */

	"slide" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 2,
		"nombre" => "Slides",
		"link" => "home_slideshow.php",
		"submenu" => array(
			array(
				"link" => "home_slideshow.php",
				"nombre" => "Ver Slides Home"
			),
			array(
				"link" => "cursos_slideshow.php",
				"nombre" => "Ver Slides Cursos"
			),
			array(
				"link" => "home_slideshow.php?action=new",
				"nombre" => "Agregar Slide Home"
			),
			array(
				"link" => "cursos_slideshow.php?action=new",
				"nombre" => "Agregar Slide Cursos"
			)
		)
	),
	"categorias" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 3,
		"nombre" => "Cursos y Categor&iacute;as",
		"link" => "categorias.php",
		"submenu" => array(
			array(
				"link" => "categorias.php",
				"nombre" => "Listado"
			),
			array(
				"link" => "categorias.php?action=new",
				"nombre" => "Agregar"
			)
		)
	),
	/* BANNERS VIEJO
	"banners" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 4,
		"nombre" => "Banners",
		"link" => "banners.php",
		"submenu" => array(
			array(
				"link" => "banners.php",
				"nombre" => "Listado de Banners"
			),
			array(
				"link" => "banners.php?action=new",
				"nombre" => "Agregar Banner"
			)
		)
	),
	FIN BANNERS VIEJO*/

	/* BANNERS HOME */


		"ban" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 4,
		"nombre" => "Banners",
		"link" => "ban.php",
		"submenu" => array(
			array(
				"link" => "banners.php?list=categoria",
				"nombre" => "Ver Banners Categorías"
			),
			array(
				"link" => "banhor.php",
				"nombre" => "Ver Banners Verticales"
			),
			array(
				"link" => "banver.php",
				"nombre" => "Ver Banners Horizontales"
			),
			array(
				"link" => "ban.php",
				"nombre" => "Agregar Banner"
			)
		)
	),



	/* FIN BANNERS HOME */

	"secciones" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 5,
		"nombre" => "Secciones",
		"link" => "secciones.php",
		"submenu" => array(
			array(
				"link" => "secciones.php",
				"nombre" => "Listado de Secciones"
			),
			array(
				"link" => "secciones.php?action=new",
				"nombre" => "Agregar Secci&oacute;n"
			)
		)
	),
	"clientes" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 5,
		"nombre" => "Convenios",
		"link" => "clientes.php",
		"submenu" => array(
			array(
				"link" => "clientes.php",
				"nombre" => "Listado de Clientes"
			),
			array(
				"link" => "clientes.php?action=new",
				"nombre" => "Agregar Cliente"
			)
		)
	),
	"testimonios" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 6,
		"nombre" => "Testimonios",
		"link" => "testimonios.php",
		"submenu" => array(
			array(
				"link" => "testimonios.php",
				"nombre" => "Listado de Testimonios"
			),
			array(
				"link" => "testimonios.php?action=new",
				"nombre" => "Agregar Testimonio"
			)
		)
	),
	"representantes" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 6,
		"nombre" => "Representantes",
		"link" => "representantes.php",
		"submenu" => array(
			array(
				"link" => "representantes.php",
				"nombre" => "Listado de Representantes"
			),
			array(
				"link" => "representantes.php?action=new",
				"nombre" => "Agregar Representante"
			)
		)
	),
	"galerias" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 6,
		"nombre" => "Galer&iacute;as",
		"link" => "galerias.php",
		"submenu" => array(
			array(
				"link" => "galerias.php",
				"nombre" => "Listado de Galer&iacute;as"
			),
			array(
				"link" => "galerias.php?action=new",
				"nombre" => "Agregar Galer&iacute;a"
			)
		)
	),

/* ACA EMPEZAMOS NOSOTROS */



	"contenido" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 7,
		"nombre" => "Contenido",
		"link" => "courses.php",
		"submenu" => array(
			array(
				"link" => "courses.php",
				"nombre" => "Listado de contenido"
			),
			array(
				"link" => "courses.php?action=new",
				"nombre" => "Agregar contenido"
			)
		)
	),


/* Libreria */

	"libreria" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 8,
		"nombre" => "Libreria",
		"link" => "libreria.php",
		"submenu" => array(
			array(
				"link" => "libreria.php",
				"nombre" => "Listado de Libros"
			),
			array(
				"link" => "libreria.php?action=new",
				"nombre" => "Agregar Libro"
			)
		)
	),


/* Noticias */

	"noticias" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 8,
		"nombre" => "Novedades",
		"link" => "noticias.php",
		"submenu" => array(
			array(
				"link" => "noticias.php",
				"nombre" => "Listado de Novedades"
			),
			array(
				"link" => "noticias.php?action=new",
				"nombre" => "Agregar Novedad"
			)
		)
	),




/* Agenda */

	"agenda" => array(
		"actions" => array("activate", "deactivate", "remove", "confirm-remove"),
		"current" => 10,
		"nombre" => "Agenda",
		"link" => "agenda.php",
		"submenu" => array(
			array(
				"link" => "agenda.php",
				"nombre" => "Listado de Agenda"
			),
			array(
				"link" => "agenda.php?action=new",
				"nombre" => "Agregar en Agenda"
			)
		)
	)


/* FIN NOSOTROS */
);



//$config["help"]["text"] = 'En caso de haber algún tipo de problema por favor contacte vía mail a <a href="mailto:'.data("webmaster-email").'">'.data("webmaster-email").'</a>';
$config["table"]["highlight"] = "highlight"; //Clase que va a poner por defecto para hacer highlight de rows
$config["page"]["current"] = $config["scope"][$scope]["current"];
?>
