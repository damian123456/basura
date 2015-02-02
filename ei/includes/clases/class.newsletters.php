<?
include_once "class.phpmailer.php";

class Newsletters{
	private $newslettersPath;

	function __construct($newslettersPath="./"){
		$this->newslettersPath = $newslettersPath;
	}

	function saveEmailAddress($email,$entityId=null){
		if(is_numeric($entityId))
			return mysql_query("INSERT INTO emails (email,id_entidad) VALUES ('$email',$entityId)");
		else
			return mysql_query("INSERT INTO emails (email) VALUES ('$email')");
	}

	function getEmailAddresses(){
		$sql = "SELECT e.* FROM emails AS e LEFT JOIN entidades AS en ON en.id=e.id_entidad";
		if($res = mysql_query($sql))
			while($row = mysql_fetch_assoc($res))
				$emails[] = $row;
		return $emails;
	}
}
?>
