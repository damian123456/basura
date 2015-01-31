<?	
/*
	* Para utilizar esta clase:
	* $registro = new Registro();
	* 
	* Si tenemos una sola tabla de usuarios
	* $registro->nuevo_usuario($datos_usuarios);
	* 
	* Si tenemos una tabla de usuarios y otra de perfiles
	* $registro->nuevo_usuario($datos_usuarios, $datos_perfiles);
*/

	class Registro{
		
		var $insert_user;
		
		function __construct__($tabla_usuarios = 'usuarios', $tabla_perfiles = 'perfiles'){
			$this->tabla_usuarios = $tabla_usuarios;
			$this->tabla_perfiles = $tabla_perfiles;
		}
		
		
		function nuevo_usuario($datos_usuarios = null, $datos_perfiles = null){
			global $db;
			if($datos_usuarios){
				foreach($datos_usuarios as $tipo_usuarios => $dato_usuarios){
					$fields_usuarios = $fields_usuarios."$tipo_usuarios = '{$dato_usuarios}',";
				}			
				
				// Eliminamos la última coma ","
				$fields_usuarios = substr($fields_usuarios,0,-1);
				
				// Buscamos si está repetido el nombre de usuario
				$check = $db->fetch_item("SELECT * FROM {$this->tabla_usuarios} WHERE username = '{$datos_usuarios['username']}'");				
				
				// Si no lo está... lo guardamos
				if(!$check)
					$this->insert_user = $db->insert("INSERT INTO {$this->tabla_usuarios} SET $fields_usuarios");
				
				// Si no hubo ningún error
				if(!$db->error())
					$errores = false;
				else
					$errores[] = $db->error();
			}
			
			if($datos_perfiles){
				foreach($datos_perfiles as $tipo_perfiles => $dato_perfiles){
					$fields_perfiles = $fields_perfiles."$tipo_perfiles = '{$dato_perfiles}',";
				}
				
				// Obtenemos el ID del usuario para que quede relacionado
				$fields_perfiles .= "id_usuario = {$this->insert_user}";
				if($this->insert_user) $insert_perfil = $db->insert("INSERT INTO {$this->tabla_perfiles} SET $fields_perfiles");
				
				if(!$db->error())
					$errores = false;
				else
					$errores[] = $db->error();
			}
			
			if($errores)
				return $errores;
			else
				return (!$check?$this->insert_user:$check['id']);
		}
		
	}
	
?>
