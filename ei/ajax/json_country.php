<?
	include('../includes/init.php');
	
	if(!isset($_GET['country']))
		$countries = $db->fetch_all("SELECT * FROM Country");
	else{
		$code = $db->escape_string($_GET['country']);
		$cities = $db->fetch_all("SELECT * FROM City WHERE CountryCode = '{$code}'");
	}
	
	if($countries) $res['countries'][] = $countries;
	if($cities) $res['cities'][] = $cities;
	
	
	print json_encode($res);
?>
