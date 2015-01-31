<?
	switch($_POST['form_type']){
		case 'contact_form':
			include 'clases/class.mailer.php';

			$data = array(
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'phone' => $_POST['phone'],
				'country' => $_POST['country'],
				'state' => $_POST['state'],
				'city' => $_POST['city'],
				'zip' => $_POST['zip'],
				'language' => $_POST['language'],
				'message' => $_POST['message']
			);

			$country = $db->fetch_item_field("SELECT Name FROM Country WHERE id=".intval($_POST['country']));
			$idioma = $db->fetch_item_field("SELECT nombre FROM categorias WHERE id=".intval($_POST['language']));

			$body = "
				Se ha enviado un mensaje de contacto desde el sitio $nombre_sitio con los siguientes datos:<br><br>
				<hr>
				<b>Nombre: </b> {$_POST['name']}<br>
				<b>Email: </b> {$_POST['email']}<br>
				<b>Telefono: </b> {$_POST['phone']}<br>
				<b>Pais: </b> {$country}<br>
				<b>Provincia: </b> {$_POST['state']}<br>
				<b>Ciudad: </b> {$_POST['city']}<br>
				<b>CP: </b> {$_POST['zip']}<br>
				<b>Idioma: </b> {$idioma}<br>
				<b>Mensaje: </b><br>{$_POST['message']}<br>
				<hr>
			";

			$subject = 'Mensaje de contacto enviado desde '.$nombre_sitio;
			$mailer = new Mailer();

			if($mailer->enviar($mail_contacto,$nombre_contacto,$_POST['email'],$_POST['name'],$subject,$body,$html=true)){
				$response = array(
					'success' => true,
					'message' => 'Tu mensaje ha sido enviado correctamente. Muchas gracias!'
				);
			} else {
				$response = array(
					'success' => false,
					'message' => $mailer->error
				);
			}
			die(json_encode($response));
			break;

		case 'register_form':
			include 'clases/class.mailer.php';

			$course_variation = explode('|',$_POST['course']);
			$course_id = $course_variation[0];
			$variation_id = $course_variation[1];

			$data = array(
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'phone' => $_POST['phone'],
				'age' => $_POST['age'],
				'country' => $_POST['country'],
				'state' => $_POST['state'],
				'city' => $_POST['city'],
				'zip' => $_POST['zip'],
				'course' => $course_id,
				'variation' => $variation_id,
				'payment' => $_POST['payment'],
				'message' => $_POST['message']
			);
			
			if($_POST['payment']==2){
				$payment_text = "Pago mensual";
			} else {
				$_POST['payment'] = 1;
				$payment_text = "Curso completo";
			}

			$country = $db->fetch_item_field("SELECT Name FROM Country WHERE id=".intval($_POST['country']));
			$curso = $db->fetch_item("SELECT id,id_category,title FROM courses WHERE id=".intval($course_id));
			$categoria = $db->fetch_item_field("SELECT nombre FROM categorias WHERE id=".intval($curso['id_category']));
			$modalidad = $db->fetch_item("SELECT * FROM courses_variations WHERE id=".intval($variation_id));

			$body = "
				Se ha enviado una solicitud de inscripci&oacute;n desde el sitio $nombre_sitio con los siguientes datos:<br><br>
				<hr>
				<b>Nombre: </b> {$_POST['name']}<br>
				<b>Email: </b> {$_POST['email']}<br>
				<b>Telefono: </b> {$_POST['phone']}<br>
				<b>Edad: </b> {$_POST['age']}<br>
				<b>Pais: </b> {$country}<br>
				<b>Provincia: </b> {$_POST['state']}<br>
				<b>Ciudad: </b> {$_POST['city']}<br>
				<b>CP: </b> {$_POST['zip']}<br>
				<b>Curso: </b> {$categoria} - {$curso['title']} - {$modalidad['title']}<br>
				<b>Tipo de Pago: </b> {$payment_text}<br>
				<b>Mensaje: </b><br>{$_POST['message']}<br>
				<hr>
			";

			$subject = 'Solicitud de inscripción enviada desde '.$nombre_sitio;
			$mailer = new Mailer();
			if($mailer->enviar($mail_contacto,$nombre_contacto,$_POST['email'],$_POST['name'],$subject,$body,$html=true)){
				$response = array(
					'success' => true,
					'message' => 'El formulario se ha enviado con éxito.<br>Ya puedes pagar tu curso.'
				);
				$availableForPurchase = true;
				
				$nombre_item = urlencode("{$categoria} - {$curso['title']} - {$modalidad['title']}");
				if($_POST['payment'] == 1){
					$precio_item = $modalidad['price'];
				} else {
					$precio_item = $modalidad['monthly_price'];
				}
				
				if($availableForPurchase){
					if($modalidad['free_variation']){
						$response['message'] = 'Su mensaje ha sido enviado con exito. Nos pondremos en contacto con usted a la brevedad.';
					} elseif(!$modalidad['available']){
						$response['message'] = 'Su mensaje ha sido enviado con exito, por el momento este curso no esta disponible, nos pondremos en contacto con usted a la brevedad.';
					} else {
						$precio_item = urlencode(str_replace('.',',',floatval($precio_item)));
						$E_Comercio = $config['dineromail_e_comercio'];
						$tipo_moneda = $config['dineromail_tipo_moneda'];
						$image_url = urlencode($config['dineromail_image_url']);
						$nro_item = $curso['id_category'].'|'.$curso['id'].'|'.$modalidad['id'];
						$dineromail_url = "https://argentina.dineromail.com/Shop/Shop_Ingreso.asp?NombreItem={$nombre_item}&TipoMoneda={$tipo_moneda}&PrecioItem={$precio_item}&E_Comercio={$E_Comercio}&NroItem={$nro_item}&image_url={$image_url}";
						$response['message'] .= '<a href="'.$dineromail_url.'" class="checkout"><img src="'. url('img/course/register-checkout.png') .'" alt="Pagar con DineroMail" /></a>';
					}
				}
			} else {
				$response = array(
					'success' => false,
					'message' => $mailer->error
				);
			}
			die(json_encode($response));
			break;
	}
