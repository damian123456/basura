<?php 

	if(isset($_POST['email'])) {

		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = "hola@conceptovisualweb.com";
		$email_subject = "Consulta sobre Franquicia";


		$email_message = "Datos del visitante interesado en la Franquicia:\n\n";
		$email_message .= "Nombre: " . $_POST['nombre'] . "\n";
		$email_message .= "E-mail: " . $_POST['email'] . "\n";
		$email_message .= "Telefono: " . $_POST['telefono'] . "\n";
		$email_message .= "Idioma: " . $_POST['idioma'] . "\n";
		$email_message .= "Comentarios: " . $_POST['comentarios'] . "\n";

		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'From: '.$_POST['email']."\r\n".
		'Reply-To: '.$_POST['email']."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);

		header("Location: franquicias-enviado.php");
		}

?>
