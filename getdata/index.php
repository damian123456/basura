<?php
include_once("simple_html_dom.php");

$url = $_GET["url"];
$html = file_get_html($url);

if($html && is_object($html) && isset($html->nodes)){
// Find all images on webpage
foreach($html->find('img') as $element){
	echo $element->src . '<br>';
	}
 
// Find all links on webpage
foreach($html->find('a') as $element){
	echo $element->href . '<br>';
	}
}else{
	echo "no anda, guacho";
}


/*
$página_inicio = file_get_contents('http://www.holaracrac.com/');
echo $página_inicio;
*/

?>
