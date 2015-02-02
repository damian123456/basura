<?php
$config["alerta"]["config"] = array(
	"exito" => array(
		"class" => "alert-success"
	),
	"error" => array(
		"class" => "alert-error"
	)	,
	"aviso" => array(
		"class" => "alert-warning"
	),
	"info" => array(
		"class" => "alert-info"
	),
	"common" => array(
		"close" => '<button type="button" class="close" data-dismiss="alert">&times;</button>'
	)	
);
if(count($config["alerta"]["trow"])){ //Si hay alertas
	foreach($config["alerta"]["trow"] as $alerta){
		echo '<div class="alert alert-block '.$config["alerta"]["config"][$alerta["type"]]["class"].' fade in" data-alert="alert">';
		if($alerta["close"]!="hide") echo $config["alerta"]["config"]["common"]["close"];
		echo $alerta["msj"];
		echo "</div>";
	}
}
?>