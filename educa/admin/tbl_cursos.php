<?

	include('inc/init.php');

	$action = $_REQUEST['action'];
	$id = intval($_REQUEST['id']);

	$upload_dir = '../uploads/';
	$upload_uri = $base.'uploads/';

	$create_fixed_variations = array("Auto-Evaluativo","Con Clases en Vivo");

	function buildCategoriesBreadcrumb($id,$array){
		$parents = array($id);
		$parent = $array[$id]['parent'];
		while($parent != 0){
			array_push($parents,$parent);
			$parent = $array[$parent]['parent'];
		}
		$parents = array_reverse($parents);
		foreach($parents as $k => $v){
			$parents[$k] = $array[$v]['nombre'];
		}
		return $parents;
	}

	function strip_base64_images($content,&$images=null){
		$parts = explode('"data:image',$content);
		$content = array_shift($parts);
		$images = array();
		foreach($parts as $p){
			$tmp = explode('"',$p);
			$image_base64 = 'data:image'.array_shift($tmp);
			$imgid = uniqid('img_');
			$images[$imgid] = $image_base64;
			$content.='"[!'.$imgid.'!]"'.implode('"',$tmp);
		}
		return $content;
	}

	function saveImages($images,$content,$upload_dir,$upload_uri,$name_prefix=''){
		foreach($images as $id => $img){
			$type = substr($img,0,strpos($img,',')+1);
			switch($type){
				case 'data:image/png;base64,':
					$extension = 'png';
					break;
				case 'data:image/jpeg;base64,':
					$extension = 'jpg';
					break;
				case 'data:image/gif;base64,':
					$extension = 'gif';
					break;
			}
			$img = str_replace($type, '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = uniqid($name_prefix) . '.' . $extension;

			$success = file_put_contents($upload_dir.$file, $data);
			$content = str_replace('[!'.$id.'!]',$upload_uri.$file,$content);
		}
		return $content;
	}

	switch($_SESSION['msg_code']){
		case 1:
			$mensajes[] = 'La tabla fue <strong>actualizada</strong> con éxito';
		break;
		case 2:
			$mensajes[] = 'La tabla fue <strong>añadida</strong> con éxito';
		break;
		case 3:
			$mensajes[] = 'La tabla fue <strong>eliminada</strong> con éxito';
		break;
	}
	$_SESSION['msg_code'] = null;
	unset($_SESSION['msg_code']);

	if($id){
	
		$item = $db->fetch_item("SELECT * FROM tbl_cursos WHERE id=$id");
		$item['variations'] = $db->fetch_all("SELECT * FROM tbl_variations WHERE id_course=$id ORDER BY id");
		if(is_array($item['variations'])) foreach($item['variations'] as $k => $v){
			$item['variations'][$k]['items'] = $db->fetch_all("SELECT * FROM tbl_variations_items WHERE id_variation={$v['id']} ORDER BY position");
		}
	}

	if($_POST['save']){
		$content = strip_base64_images($_POST['content'],$images);

		$contentf2 = strip_base64_images($_POST['contentf2'],$images);
		$contentf3 = strip_base64_images($_POST['contentf3'],$images);
		$contentf4 = strip_base64_images($_POST['contentf4'],$images);
		$contentf5 = strip_base64_images($_POST['contentf5'],$images);
		$contentf6 = strip_base64_images($_POST['contentf6'],$images);
		$contentf7 = strip_base64_images($_POST['contentf7'],$images);
		$contentf8 = strip_base64_images($_POST['contentf8'],$images);

		if(!empty($_POST['title'])){
			$title = $db->escape_string($_POST['title']);
			$category = intval($_POST['category']);
		}
		$col1f1 = $db->escape_string($_POST['col1f1']);
		$col2f1 = $db->escape_string($_POST['col2f1']);
		$col3f1 = $db->escape_string($_POST['col3f1']);
		$col3f2 = $db->escape_string($_POST['col3f2']);
		$content = $db->escape_string($content);
		$excerpt = $db->escape_string($_POST['excerpt']);

		$col1f1f2 = $db->escape_string($_POST['col1f1f2']);
		$col2f1f2 = $db->escape_string($_POST['col2f1f2']);
		$col3f1f2 = $db->escape_string($_POST['col3f1f2']);
		$col3f2f2 = $db->escape_string($_POST['col3f2f2']);
		$contentf2 = $db->escape_string($contentf2);
		$excerptf2 = $db->escape_string($_POST['excerptf2']);

		$col1f1f3 = $db->escape_string($_POST['col1f1f3']);
		$col2f1f3 = $db->escape_string($_POST['col2f1f3']);
		$col3f1f3 = $db->escape_string($_POST['col3f1f3']);
		$col3f2f3 = $db->escape_string($_POST['col3f2f3']);
		$contentf3 = $db->escape_string($contentf3);
		$excerptf3 = $db->escape_string($_POST['excerptf3']);

		$col1f1f4 = $db->escape_string($_POST['col1f1f4']);
		$col2f1f4 = $db->escape_string($_POST['col2f1f4']);
		$col3f1f4 = $db->escape_string($_POST['col3f1f4']);
		$col3f2f4 = $db->escape_string($_POST['col3f2f4']);
		$contentf4 = $db->escape_string($contentf4);
		$excerptf4 = $db->escape_string($_POST['excerptf4']);

		$col1f1f5 = $db->escape_string($_POST['col1f1f5']);
		$col2f1f5 = $db->escape_string($_POST['col2f1f5']);
		$col3f1f5 = $db->escape_string($_POST['col3f1f5']);
		$col3f2f5 = $db->escape_string($_POST['col3f2f5']);
		$contentf5 = $db->escape_string($contentf5);
		$excerptf5 = $db->escape_string($_POST['excerptf5']);

		$col1f1f6 = $db->escape_string($_POST['col1f1f6']);
		$col2f1f6 = $db->escape_string($_POST['col2f1f6']);
		$col3f1f6 = $db->escape_string($_POST['col3f1f6']);
		$col3f2f6 = $db->escape_string($_POST['col3f2f6']);
		$contentf6 = $db->escape_string($contentf6);
		$excerptf6 = $db->escape_string($_POST['excerptf6']);

		$col1f1f7 = $db->escape_string($_POST['col1f1f7']);
		$col2f1f7 = $db->escape_string($_POST['col2f1f7']);
		$col3f1f7 = $db->escape_string($_POST['col3f1f7']);
		$col3f2f7 = $db->escape_string($_POST['col3f2f7']);
		$contentf7 = $db->escape_string($contentf7);
		$excerptf7 = $db->escape_string($_POST['excerptf7']);

		$col1f1f8 = $db->escape_string($_POST['col1f1f8']);
		$col2f1f8 = $db->escape_string($_POST['col2f1f8']);
		$col3f1f8 = $db->escape_string($_POST['col3f1f8']);
		$col3f2f8 = $db->escape_string($_POST['col3f2f8']);
		$contentf8 = $db->escape_string($contentf8);
		$excerptf8 = $db->escape_string($_POST['excerptf8']);


		if(!$title)
			$errores[] = 'El titulo no puede estar vac&iacute;o';

		if(empty($errores)){

			if($item){
				$img_prefix = "img-c{$item['id']}-";
				$content = saveImages($images,$content,$upload_dir,$upload_uri,$img_prefix);
			}
			$fields = "
				title = '{$title}',
				id_category = '{$category}',

				col1f1 = '{$col1f1}',
				col2f1 = '{$col2f1}',
				col3f1 = '{$col3f1}',
				col3f2 = '{$col3f2}',
				content = '{$content}',
				excerpt = '{$excerpt}',

				col1f1f2 = '{$col1f1f2}',
				col2f1f2 = '{$col2f1f2}',
				col3f1f2 = '{$col3f1f2}',
				col3f2f2 = '{$col3f2f2}',
				contentf2 = '{$contentf2}',
				excerptf2 = '{$excerptf2}',

				col1f1f3 = '{$col1f1f3}',
				col2f1f3 = '{$col2f1f3}',
				col3f1f3 = '{$col3f1f3}',
				col3f2f3 = '{$col3f2f3}',
				contentf3 = '{$contentf3}',
				excerptf3 = '{$excerptf3}',

				col1f1f4 = '{$col1f1f4}',
				col2f1f4 = '{$col2f1f4}',
				col3f1f4 = '{$col3f1f4}',
				col3f2f4 = '{$col3f2f4}',
				contentf4 = '{$contentf4}',
				excerptf4 = '{$excerptf4}',

				col1f1f5 = '{$col1f1f5}',
				col2f1f5 = '{$col2f1f5}',
				col3f1f5 = '{$col3f1f5}',
				col3f2f5 = '{$col3f2f5}',
				contentf5 = '{$contentf5}',
				excerptf5 = '{$excerptf5}',

				col1f1f6 = '{$col1f1f6}',
				col2f1f6 = '{$col2f1f6}',
				col3f1f6 = '{$col3f1f6}',
				col3f2f6 = '{$col3f2f6}',
				contentf6 = '{$contentf6}',
				excerptf6 = '{$excerptf6}',

				col1f1f7 = '{$col1f1f7}',
				col2f1f7 = '{$col2f1f7}',
				col3f1f7 = '{$col3f1f7}',
				col3f2f7 = '{$col3f2f7}',
				contentf7 = '{$contentf7}',
				excerptf7 = '{$excerptf7}',

				col1f1f8 = '{$col1f1f8}',
				col2f1f8 = '{$col2f1f8}',
				col3f1f8 = '{$col3f1f8}',
				col3f2f8 = '{$col3f2f8}',
				contentf8 = '{$contentf8}',
				excerptf8 = '{$excerptf8}',

				active = 1
			";

			if($item){
				$db->update("UPDATE tbl_cursos SET {$fields} WHERE id={$item['id']}");
				if(is_array($_POST['variations_prices'])) foreach($_POST['variations_prices'] as $v => $price){
					$price = floatval($price);
					$monthly_price = floatval($_POST['variations_monthly_prices'][$v]);
					$duration = $db->escape_string($_POST['variations_durations'][$v]);
					$payment_gateway_url = $db->escape_string($_POST['variations_payment_gateway_url'][$v]);
					$available_checkbox = $db->escape_string($_POST['variations_available_checkbox'][$v]);
					$free_variation_checkbox = $db->escape_string($_POST['variations_free_variation'][$v]);
					
					$payment_available = 0;
					if($available_checkbox) 
						$payment_available = 1;
					
					$free_variation = 0;
					if($free_variation_checkbox) 
						$free_variation = 1;
					
					$db->update("UPDATE tbl_variations SET price='$price',monthly_price='$monthly_price',duration='$duration', payment_gateway_url='$payment_gateway_url', free_variation = {$free_variation}, available = {$payment_available} WHERE id=$v");
				}
				if(is_array($_POST['items'])) foreach($_POST['items'] as $v => $items){
					$v = intval($v);
					$db->delete("DELETE FROM tbl_variations_items WHERE id_variation=$v");
					$pos = 0;
					if(is_array($items)) foreach($items as $i){
						$pos++;
						if($i){
							$i = $db->escape_string($i);
							$db->insert("INSERT INTO courses_variations_items SET id_variation=$v, value='$i', position=$pos");
						}
					}
				}
			} else {
				$id = (int)$db->insert("INSERT INTO tbl_cursos SET {$fields},position=999,added=NOW()");

				$img_prefix = "img-c{$id}-";
				$content = saveImages($images,$content,$upload_dir,$upload_uri,$img_prefix);
				$db->update("UPDATE tbl_cursos SET content='$content' WHERE id=$id");

				if(!$db->errno() && is_array($create_fixed_variations)){
					foreach($create_fixed_variations as $title){
						$title = $db->escape_string($title);
						$db->insert("INSERT INTO tbl_variations SET id_course='$id', title='$title', description='', price='0.00'");
					}
				}
			}

			// Delete trash images
			$prevdir = getcwd();
			chdir($upload_dir);
			$files = glob("{$img_prefix}*");
			foreach($files as $f){
				if(strpos($content,$f)===false) @unlink($f);
			}
			chdir($prevdir);

			if(isset($_POST['apply'])){
				redirect("tbl_cursos.php?id={$id}");
			} else {
				/* REDIRECCION A TBL_CURSOS*/
				redirect("tbl_cursos.php");
			}

		}
	}

	if($_GET['action'] == 'delete'){

		if($item){
			$db->delete("DELETE FROM tbl_cursos WHERE id={$item['id']}");

			if(!$db->error()){
				$_SESSION['msg_code'] = 3;
				redirect('tbl_cursos.php');
			} else {
				$errores[] = $db->error();
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
		<meta charset="<?=$charset?>">
		<meta name="robots" content="noindex">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?=$nombre_sitio?> - Panel de Administración</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/estilos.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="js/jquery.showLoading.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-wysiwyg.js"></script>
		<script src="js/jquery.sieve.min.js"></script>

		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

		<!-- include summernote css/js-->
		<link rel="stylesheet" href="css/summernote.css" />
		<!-- <script src="../../../summernote/dist/summernote.js"></script> -->
		<script src="js/summernote.custom.js"></script>
		<script src="js/courses.js"></script>

		<style type="text/css">
		#editor{
			background-color: white;
			border-collapse: separate;
			border: 1px solid rgb(204, 204, 204);
			padding: 4px;
			-moz-box-sizing: content-box;
			box-sizing: content-box;
			-webkit-box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
			box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
			border-top-right-radius: 3px;
			border-bottom-right-radius: 3px;
			border-bottom-left-radius: 3px;
			border-top-left-radius: 3px;
			overflow: scroll;
			outline: none;
			max-width:100%;
			width:99%;
			max-height:600px;
			height:600px;
		}
		.form-horizontal .form-group{
			margin-left:0;
			margin-right:0;
		}
		</style>
</head>

<body>
	<div class="container">
		<? include("includes/layout/header.php"); ?>
		<div class="well box">
			<? include("includes/layout/menu.php"); ?>
			<? include("includes/functions/alertas.php"); ?>
			<div class="contenido row">
				<div class="col-sm-12">
				<? if($errores){ ?><div class="alert alert-error"><ul><li><?=implode('</li><li>',$errores)?></li></ul></div><? } ?>
				<? if($mensajes){ ?><div class="alert alert-success"><ul><li><?=implode('</li><li>',$mensajes)?></li></ul></div><? } ?>

<?
				$categories_array = $db->fetch_all("SELECT * FROM categorias ORDER BY parent,orden,nombre");
				$categories = build_tree($categories_array);

				/* CONTROL DE FLUJO DE $action */

				if($item || $action=='new'){
					include 'templates/tbl_cursos_add.php';
				} else {
					$tmp_cats = $db->fetch_all("SELECT * FROM categorias ORDER BY parent, orden, id");
					if(is_array($tmp_cats)) {
						$cats = $tmp_cats;
						foreach($tmp_cats as $c){
							$tmp = $db->fetch_all("
								SELECT c.id AS id_course,c.title AS nombre, c.id_category AS parent, c2.nombre AS parent_name, cat.nombre AS slug_category FROM tbl_cursos AS c
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
					$items = build_tree($cats);

					
					//include 'templates/tbl_cursos_addd.php'; // Agrego el archivo que carga la fila
					include 'templates/tbl_cursos_list.php';
				}
?>

				</div>
			</div>
			<?php include("includes/layout/footer.php"); ?>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$(".alert").alert();
			$('.dropdown-toggle').dropdown();
		});
	</script>
</body>
</html>
