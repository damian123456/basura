<?
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
			return "ConceptoVisual";
		break;
		case "webmaster-email":
			return "hola@conceptoviaulweb.com";
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
}
?>
