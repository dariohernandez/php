<?php 

class userController {

	public function __construct(){}

	public function activaCta(){

		if(isset($_GET["key"]) && isset($_SESSION["user_id"])){

			if(Usuario::activaCtaUsuario($_GET["key"])) header('location: ?view=home&success=true'); //La funcion perteneciente a la clase usuario devuelve TRUE si se ejcuta correctamente. Caso contrario FALSE
			else header('location: ?view=home&error=true');

			} else header('location: ?view=home');


	}

	public function recoverPass(){

		if(!isset($_SESSION["user_id"]) && isset($_GET["key"])){
			
			$data = Usuario::updateRCVPassword($_GET["key"]);
			
			if (!is_null($data)){

				$_SESSION["new_pass"] = $data["RecoverPassword"];

				header('location: ?view=home&updatePass=true');

			} else header('location: ?view=home');

		} else header('location: ?view=home');

	}

	public function logOut(){

		if(isset($_SESSION["user_id"])) unset($_SESSION["user_id"]);
	
		header('location: ?view=home');
	}
}


 ?>