<?
	include('../includes/init.php');

	$metodologia = $_GET['id_metodologia'];
	$arr_id_metodologia = explode('|', $metodologia);
	$id_metodologia = $arr_id_metodologia[1];

	if($id_metodologia>0){
		$check = $db->fetch_item("
			SELECT cv.* FROM courses_variations AS cv
				JOIN courses AS c
					ON c.id = cv.id_course
				JOIN categorias AS cat
					ON cat.id = c.id_category
			WHERE cv.id = {$id_metodologia}
		");
		
		if($check['available']){
			if(!$check['free_variation']){				
				if($check['price']>0){
					$tmp['id'] = 1;
					$tmp['text_payment'] = 'Curso completo';
					$res[] = $tmp;
				}
				
				if($check['monthly_price']>0){
					$tmp['id'] = 2;
					$tmp['text_payment'] = 'Pago mensual';
					$res[] = $tmp;
				}
			}else{
				$tmp['id'] = '-1';
				$tmp['text_payment'] = 'Curso gratuito';
				$res[] = $tmp;
			}

		}else
			$res['error'] = 'No está disponible para la compra';
	}else
		$res['error'] = 'Faltan datos';

	print json_encode($res);
?>
