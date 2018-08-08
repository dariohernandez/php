<?php 

//Clase encargada de la configuración de parametros

abstract class Config{

	protected $database; // Se define como protected para poder ser usada por las clases hijas
	protected function conexion($archivo= 'Core/config.ini'){

		if(!$conf = parse_ini_file($archivo, true)) throw new exception('No se puede abrir el archivo de configuracion: '.$archivo); // Genera la excepcion si no se puede abrir el archivo
		
		$db_type= $conf["database"]["type"];
		$db_name= $conf["database"]["name"];
		$server_name= $conf["database"]["server"];
		$db_user= $conf["database"]["user"];
		$db_pass= $conf["database"]["pass"];

		try{
			// Retorna el objeto PDO
			return $this->database = new PDO(
				"$db_type:host=$server_name;dbname=$db_name;",$db_user,$db_pass,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

			//$this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo "Fallo en la conexion a la BDs: " .$e->getMessage();

		}
	}

}

 ?>