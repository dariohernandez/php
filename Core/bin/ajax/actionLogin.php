<?php

$dataUser = $_POST["usuLogin"];

$pass = encriptar($_POST["passLogin"]);

$id_user = Usuario::login($dataUser, $pass); // El login retorna -1 si el usuario no fue encontrado. O su ID en caso contrario
	if ($id_user >= 0){
		
		if ($_POST["saveLogin"]) ini_set('session.cookie_lifetime', time()+ 20); // Establecer el tiempo de vida de la sesion como 1 minuto, si el checkbox fuese activado

		$_SESSION["user_id"]= $id_user;
		$HTML = 1; //Login de usuario correcto
	}
	else $HTML = "warning, ERROR, No se ha encontrado un usuario existente con esas creenciales. Intenta nuevamente.";

echo $HTML;

?>