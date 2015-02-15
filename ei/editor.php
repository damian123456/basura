<head>
	<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Asap:400,400italic,700" rel="stylesheet" type="text/css">
</head>
<body>
	
<?
	require_once("includes/config.php");

	    if (isset($_GET['content'])){

	        $id = $_GET['content'];
	        $contenido = $db->fetch_item("SELECT * FROM courses WHERE id = $id");
	    	echo $contenido['content'];
	    }
?>

</body>
