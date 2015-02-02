<?
	$curdir = getcwd();
	chdir('..');
	include('inc/init.php');
	chdir($curdir);

	$action = $_REQUEST['do'];
	$courseId = (int)$_REQUEST['courseId'];

	switch ($action){
		case 'getVariationData':
			$variationId = (int)$_REQUEST['variationId'];
			$ret = $db->fetch_item("SELECT * FROM courses_variations WHERE id=$variationId LIMIT 1");
			break;

		case 'deleteVariation':
			$variationId = (int)$_REQUEST['variationId'];
			$ret = $db->delete("DELETE FROM courses_variations WHERE id=$variationId LIMIT 1");
			break;

		case 'saveVariation':
			$variationId = (int)$_REQUEST['variationId'];
			$title = $db->escape_string($_REQUEST['title']);
			$description = $db->escape_string($_REQUEST['description']);
			$price = floatVal($_REQUEST['price']);

			$fields = "
				id_course = $courseId,
				title = '$title',
				description = '$description',
				price = '$price'
			";

			if($variationId){
				$db->update("UPDATE courses_variations SET $fields WHERE id=$varietyId");
			} else {
				$variationId = $db->insert("INSERT INTO courses_variations SET $fields");
			}
			if($variationId && $db->errno()==0){
				$ret = array( 'success' => true );
			} else {
				$ret = array(
					'error' => $db->error(),
					'success' => false
				);
			}
			break;

		case 'getPropertyData':
			$propertyId = (int)$_REQUEST['propertyId'];
			$ret = $db->fetch_item("SELECT * FROM courses_properties WHERE id=$propertyId LIMIT 1");
			break;

		case 'deleteProperty':
			$propertyId = (int)$_REQUEST['propertyId'];
			$ret = $db->delete("DELETE FROM courses_properties WHERE id=$propertyId LIMIT 1");
			break;

		case 'saveProperty':
			$propertyId = (int)$_REQUEST['propertyId'];
			$name = $db->escape_string($_REQUEST['name']);
			$help = $db->escape_string($_REQUEST['help']);
			$type = $db->escape_string($_REQUEST['type']);
			if($type=='bool'){
				$default_value = intVal($_REQUEST['yes-no-default']);
			} else {
				$default_value = $db->escape_string($_REQUEST['text-default']);
			}

			$fields = "
				id_course = $courseId,
				name = '$name',
				help = '$help',
				type = '$type',
				default_value = '$default_value'
			";

			if($propertyId){
				$db->update("UPDATE courses_properties SET $fields WHERE id=$propertyId");
			} else {
				$propertyId = $db->insert("INSERT INTO courses_properties SET $fields");
			}
			if($propertyId && $db->errno()==0){
				$ret = array( 'success' => true );
			} else {
				$ret = array(
					'error' => $db->error(),
					'success' => false
				);
			}
			break;

		case 'getVariationProperties':
			$variationId = (int)$_REQUEST['variationId'];
			$ret = $db->fetch_all("
				SELECT cp.*,cvp.value,cvp.display
				FROM courses_properties AS cp
				LEFT JOIN courses_variations_properties AS cvp
					ON cvp.id_variation = $variationId
					AND cvp.id_property = cp.id
				WHERE
					cp.id_course = $courseId
				ORDER BY cp.position,cp.id
			");
			break;

		case 'saveVariationProperties':
			$variationId = (int)$_REQUEST['variationId'];
			foreach($_POST['values'] AS $propertyId => $val){
				$val = $db->escape_string($val);
				$display = intval($_POST['display'][$propertyId]);
				$db->update("INSERT INTO courses_variations_properties SET id_variation=$variationId, id_property=$propertyId, value='$val', display='$display' ON DUPLICATE KEY UPDATE value='$val', display='$display' ");
			}
			$ret = array('success' => true);
			break;
	}

	echo json_encode(utf8_encode_all($ret));
