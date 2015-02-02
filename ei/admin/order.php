<?
	include('inc/init.php');

	$id = (int)$_GET['id'];
	$orden = $_GET['orden'];

	$arrOrder = explode(',',$orden);

	if($arrOrder) foreach($arrOrder as $k => $ao){
		$orden = $k;
		$arr_type = explode("_",$ao);
		$id_item = trim($arr_type[1]);

		if(isset($_GET['order_general']) && $id_item){
			switch($arr_type[0]){
				case 'cliente':
					$db->update("UPDATE clientes SET orden = {$orden} WHERE id = {$id_item}");
				break;
				case 'banner':
					$db->update("UPDATE banners SET orden = {$orden} WHERE id = {$arr_type[2]}");
				break;
				case 'seccion':
					$db->update("UPDATE secciones SET orden = {$orden} WHERE id = {$id_item}");
				break;
				case 'slide':
					$db->update("UPDATE home_slideshow SET position = {$orden} WHERE id = {$id_item}");
				break;
				case 'testimonio':
					$db->update("UPDATE testimonios SET orden = {$orden} WHERE id = {$id_item}");
				break;
				case 'categoria':
					$db->update("UPDATE categorias SET orden = {$orden} WHERE id = {$id_item}");
				break;
				case 'curso':
					$db->update("UPDATE courses SET position = {$orden} WHERE id = {$id_item}");
				break;
				case 'galeria':
					$db->update("UPDATE galerias SET orden = {$orden} WHERE id = {$id_item}");
				break;
				case 'content':
					$db->update("UPDATE galerias_contenido SET orden = {$orden} WHERE id = {$id_item}");
				break;
				
				/* ACA INTERVENIMOS NOSOTROS */

				case 'cursos':
					$db->update("UPDATE cursos SET orden = {$orden} WHERE id = {$id_item}");
				break;
				case 'libreria':
					$db->update("UPDATE libreria SET posicion = {$orden} WHERE id = {$id_item}");
				break;
				case 'noticias':
					$db->update("UPDATE noticias SET orden = {$orden} WHERE id = {$id_item}");
				break;
				case 'agenda':
					$db->update("UPDATE agenda SET orden = {$orden} WHERE id = {$id_item}");
				break;

				/* FIN NOSOTROS */
			}

		}

		print $db->error();
	}
?>
