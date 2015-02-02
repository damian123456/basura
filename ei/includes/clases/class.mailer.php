<?
include_once "class.phpmailer.php";

class Mailer{
	private $templatesPath;
	public $charset;
	public $error;

	function __construct($templatesPath="./"){
		$this->templatesPath = $templatesPath;
		$this->charset = 'UTF-8';
	}

	function enviar($dest,$destName,$from,$fromName,$subject,$text,$html=true){
		global $config;
		$mailer = new phpmailer;
		if($config['mailer']=='smtp'){
			$mailer->isSMTP();
			$mailer->Host = $config['smtp_host'];
			$mailer->Port = $config['smtp_port'];
			if($config['smtp_auth']){
				$mailer->SMTPDebug = false;
				$mailer->SMTPAuth = true;
				$mailer->Username = $config['smtp_user'];
				$mailer->Password = $config['smtp_password'];
			}
		}
		$mailer->AddAddress($dest,$destName);
		$mailer->From = $from;
		$mailer->FromName = $fromName;
		$mailer->Subject = $subject;
		$mailer->Sender = $from;
		$mailer->CharSet = $this->charset;
		if($html){
			$mailer->IsHTML(true);
			$mailer->Body = $text;
			$mailer->AltBody = strip_tags(str_replace(array("<br>","<br />","<br/>"),array("\r\n","\r\n","\r\n"),$text));
		} else
			$mailer->Body = $text;
		$sent = $mailer->Send();
		if(!$sent) $this->error = $mailer->ErrorInfo;
		return $sent;
	}

	/*
	 * Data es un arreglo de la forma:
	 *   array("__email__" => "info@email.com", "__name__" => "Test")
	 * donde las claves del arreglo son las cadenas a buscar y el valor es el reemplazo, es decir, en este caso,
	 * se reemplazan todas las ocurrencias de __email__ por info@email.com
	 * y así con todo el resto de los elementos del arreglo.
	 *
	 */
	function enviarConPlantilla($destEmail,$destName,$fromEmail,$fromName,$subject,$template,$data=null,$html=true){
		$path = $this->templatesPath.$template;
		if(!file_exists($path))
			$path = "../".$path;

		if(!$fd = fopen($path, "r"))
			return false;
		$text = fread($fd, filesize($path));
		fclose($fd);

		if(is_array($data))
			return $this->enviar($destEmail,$destName,$fromEmail,$fromName,$subject,$this->replace_template($text, $data),$html);
		return $this->enviar($destEmail,$destName,$fromEmail,$fromName,$subject,$text,$html);
	}

	private function replace_template($text, $data){
		$search = array_keys($data);
		$replace = array_values($data);
		return str_replace($search, $replace, $text);
	}
}
?>
