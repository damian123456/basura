<?
/*
 * Clase Validator, por Matias Gea (http://www.mfgea.com.ar)
 *
 * Uso:
 * Primero se instancia la clase, luego se agregan datos
 * y después se verifica la validez de los mismo y se
 * muestran mensajes de error de ser necesario.
 *
 * $val = new Validator;
 *
 * $val->addString("Nombre de Usuario", 'joe', $requerido=true, $type=USERNAME, $min=5, $max=12);
 * $val->addPassword("Contrase&ntilde;a", "1234", "1234", $requerido=true);
 * $val->addEmail("Direcci&oacute;n de email", "joe@domain.com", $requerido=false);
 *
 * if($val->isValid()){
 * 		// Hacer algo cuando es valido
 * } else {
 * 		// print_r($val->getErrors());
 * 		print "Se han encontrado los siguientes errores:<br />- ".join("<br />- ",$val->getErrors());
 * }
 */

	/* V 0.91 */
	define("ANYTHING",1);
	define("ALPHA",1);
	define("NUMERIC",2);
	define("ALPHANUMERIC",3);
	define("ALPHANUMERIC_SYMBOLS",4);
	define("USERNAME",5);
	define("REQUIRED",true);
	define("NOT_REQUIRED",false);

	class Validator{
		private $items;
		private $errors;

		private function fixEncoding($x){
			if(mb_detect_encoding($x)== "UTF-8" && mb_check_encoding($x,"UTF-8"))
				return $x;
			else
				return utf8_encode($x);
		}

		public function __construct(){
			$this->errors = null;
		}

		public function addError($str){
			$this->errors[] = $str;
		}

		public function getErrors(){
			return $this->errors;
		}

		public function isValid(){
			return empty($this->errors);
		}

		public function addString($nombre_campo, $valor, $requerido=true, $type=ALPHANUMERIC_SYMBOLS, $min=0, $max=null){
			if(!$requerido && $valor == '')
				return true;

			if($requerido && $valor==""){
				$this->errors[] = "El campo '$nombre_campo' no puede estar vac&iacute;o.";
			}

			$valor = $this->fixEncoding($valor);

			if(strlen($valor) < $min)
				$this->errors[] = "El campo '$nombre_campo' debe tener al menos $min caracteres.";
			if($max && strlen($valor) > $max)
				$this->errors[] = "El campo '$nombre_campo' debe como m&aacute;ximo $max caracteres.";

			switch($type){
				case ANYTHING:
					break;
				case ALPHA:
					$regex = "/^[a-zA-ZáàãâÁÀÃÂéÉíÍóõôÓÕÔúüÚÜñÑ\s]+$/";
					if(!preg_match($regex, $valor))
						$this->errors[] = "El campo '$nombre_campo' debe contener s&oacute;lo letras.";
					break;
				case ALPHANUMERIC:
					$regex = "/^[a-zA-Z0-9áàãâÁÀÃÂéÉíÍóõôÓÕÔúüÚÜñÑ\s]+$/";
					if(!preg_match($regex, $valor))
						$this->errors[] = "El campo '$nombre_campo' debe contener s&oacute;lo letras y n&uacute;meros.";
					break;
				case USERNAME:
					$regex = "/^[a-zA-Z0-9_-]+$/";
					if(!preg_match($regex, $valor))
						$this->errors[] = "El campo '$nombre_campo' puede contener s&oacute;lo letras, n&uacute;meros y los caracteres _ y -.";
					break;
				case ALPHANUMERIC_SYMBOLS:
					$regex = "/^[a-zA-Z0-9áàãâÁÀÃÂéÉíÍóõôÓÕÔúüÚÜñÑ\-\!\?\.\_\+\,\:¡¿\(\)\&\%\$\|\s]+$/";
					if(!preg_match($regex, $valor))
						$this->errors[] = "El campo '$nombre_campo' puede contener: letras, n&uacute;meros y los s&iacute;mbolos: +-_,.:|&iexcl;!&iquest;?()&amp;%";
					break;
				case NUMERIC:
					if(!$requerido && $valor=='')
						if(!is_numeric($valor) && (!$requerido && $valor!=''))
							$this->errors[] = "El campo '$nombre_campo' debe ser num&eacute;rico.";
					break;
			}
			return true;
		}

		public function addEmail($nombre_campo, $valor, $requerido=true){
			if(!$requerido && $valor == '')
				return true;

			if($requerido && $valor==""){
				$this->errors[] = "El campo '$nombre_campo' no puede estar vac&iacute;o.";
				return false;
			}

			if(!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z]{2,4})$/i",$valor))
				$this->errors[] = "El campo '$nombre_campo' no es v&aacute;lido. La forma correcta es: 'nombre@dominio.com'";
			return true;
		}

		public function addPassword($nombre_campo, $password, $confirm, $requerido=true){
			if($requerido && $password==""){
				$this->errors[] = "El campo '$nombre_campo' no puede estar vac&iacute;o.";
				return false;
			}

			if($password !== $confirm){
				$this->errors[] = "El campo '$nombre_campo' no concuerda con la confirmaci&oacute;n.";
				return false;
			}
			return true;
		}


		//
		// Basado en la funcion catchDate:
		//
		public function addDate($nombre_campo, $date, $requerido=true){
			if(!$requerido && $date == '')
				return true;

			list($Day, $Month, $Year) = explode("/",$date);
			if (strlen($Year)==4)
			{
				if (!checkdate($Month,$Day,$Year))
				{
					$this->errors[] = "El campo $nombre_campo no tiene un formato correcto. La forma correcta es: '31/12/1999'";
					return false;
				}
			}
			else
			{
				$this->errors[] = "El campo $nombre_campo no tiene un formato correcto. La forma correcta es: '31/12/1999'";
				return false;
			}
			return true;
		}

	}
?>
