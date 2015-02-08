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
			$mensajes[] = 'El contenido fue <strong>actualizado</strong> con éxito';
		break;
		case 2:
			$mensajes[] = 'El contenido fue <strong>añadido</strong> con éxito';
		break;
		case 3:
			$mensajes[] = 'El contenido fue <strong>eliminado</strong> con éxito';
		break;
	}
	$_SESSION['msg_code'] = null;
	unset($_SESSION['msg_code']);

	if($id){
	
		$item = $db->fetch_item("SELECT * FROM courses WHERE id=$id");
		$item['variations'] = $db->fetch_all("SELECT * FROM courses_variations WHERE id_course=$id ORDER BY id");
		if(is_array($item['variations'])) foreach($item['variations'] as $k => $v){
			$item['variations'][$k]['items'] = $db->fetch_all("SELECT * FROM courses_variations_items WHERE id_variation={$v['id']} ORDER BY position");
		}
	}

	if($_POST['save']){
		$content = strip_base64_images($_POST['content'],$images);

		$title = $db->escape_string($_POST['title']);
		$excerpt = $db->escape_string($_POST['excerpt']);
		$category = intval($_POST['category']);
		$show_courses_explanations = ($_POST['show_courses_explanations']?1:0);
		$content = $db->escape_string($content);
		$color = $db->escape_string($_POST['color']);

		if(!$title)
			$errores[] = 'El titulo no puede estar vac&iacute;o';

		if(empty($errores)){

			if($item){
				$img_prefix = "img-c{$item['id']}-";
				$content = saveImages($images,$content,$upload_dir,$upload_uri,$img_prefix);
			}
			$fields = "
				title = '{$title}',
				excerpt = '{$excerpt}',
				id_category = '{$category}',
				content = '{$content}',
				show_courses_explanations = '{$show_courses_explanations}',
				active = 1,
				color = '{$color}'
			";

			if($item){
				$db->update("UPDATE courses SET {$fields} WHERE id={$item['id']}");
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
					
					$db->update("UPDATE courses_variations SET price='$price',monthly_price='$monthly_price',duration='$duration', payment_gateway_url='$payment_gateway_url', free_variation = {$free_variation}, available = {$payment_available} WHERE id=$v");
				}
				if(is_array($_POST['items'])) foreach($_POST['items'] as $v => $items){
					$v = intval($v);
					$db->delete("DELETE FROM courses_variations_items WHERE id_variation=$v");
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
				$id = (int)$db->insert("INSERT INTO courses SET {$fields},position=999,added=NOW()");

				$img_prefix = "img-c{$id}-";
				$content = saveImages($images,$content,$upload_dir,$upload_uri,$img_prefix);
				$db->update("UPDATE courses SET content='$content' WHERE id=$id");

				if(!$db->errno() && is_array($create_fixed_variations)){
					foreach($create_fixed_variations as $title){
						$title = $db->escape_string($title);
						$db->insert("INSERT INTO courses_variations SET id_course='$id', title='$title', description='', price='0.00'");
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
				redirect("courses.php?id={$id}");
			} else {
				redirect("courses.php");
			}

		}
	}

	if($_GET['action'] == 'delete'){

		if($item){
			$db->delete("DELETE FROM courses WHERE id={$item['id']}");

			if(!$db->error()){
				$_SESSION['msg_code'] = 3;
				redirect('courses.php');
			} else {
				$errores[] = $db->error();
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="<?=$charset?>">
		<meta name="robots" content="noindex">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?=$nombre_sitio?> - Panel de Administración</title>
		<link rel="stylesheet" href="css/bootstrap-3.0.0.min.css">
		<link rel="stylesheet" href="css/pick-a-color-1.2.3.min.css">	  
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/estilos.css" />
		<link href="css/bootstrap-colorselector.css" rel="stylesheet" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js/jquery.showLoading.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-wysiwyg.js"></script>
		<script src="js/jquery.sieve.min.js"></script>
		<script src="js/bootstrap-colorselector.js"></script>
  		<script src="js/prettify.js"></script>
        <script src="ckeditor/ckeditor.js"></script>


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

				if($item || $action=='new'){
					include 'templates/courses_add.php';
				} else {
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
					$items = build_tree($cats);

					include 'templates/courses_list.php';
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
