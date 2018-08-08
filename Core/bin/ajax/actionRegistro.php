<?php 

$userName = $_POST["txtRegUsu"];

$userMail = $_POST["txtRegCorreo"];

$userPass = encriptar($_POST["txtRegPass"]);

$data = Usuario::existeUsuario($userName, $userMail); // Coteja si el nombre de usuario o el correo ya existe, retornando de ser asi la información del usuario
	if (empty($data)){

		$key = md5(time()); // Key de registro que sera enviada al usuario
		$link = DIR_APP .'?view=user&action=activaCta&key='.$key;

		$parametrosMail = array(
				"subject" => "Activación de cuenta",
				"body" => createMailRegistro($userName,$link),
				"altBody" => 'Hola '.$userName.'. Muchas Gracias por tu registro! Ahora para activar tu cuenta dirigete a '.$link
			);

			//Llamado a la función para enviar correos, la cual retorna TRUE si se ha podido enviar o el texto del error si NO
			$response = enviaMail($userName, $userMail, $parametrosMail);
				
				if ($response){
					//echo 'success, Operacion exitosa, El mensaje se ha enviado';
					$id_newUser = Usuario::addUsuario($userName, $userPass, $userMail, $key);
						
						//Validar si se llevo a cabo la inserción correctamente	
						if ($id_newUser >= 0) {
							$_SESSION["user_id"]= $id_newUser; // Generar la variable de sesión con el retorno de la función
							$HTML = 1;
						} else $HTML ="danger, ERROR:, No se ha podido completar el registro de cuenta";

				} else $HTML = $response; // else echo 'danger, ERROR, El mensaje no hay sido enviado. Mailer Error: '. $mail->ErrorInfo;

	} else {
		//Obtener el Nombre de usuario de la segunda posicion del array resultante y compararlo con el parametro
		($data->getNombreUsuario() == $userName) ? $mensaje=" El usuario que ingresaste ya existe. Por favor elije otro." : $mensaje=" Existe otro usuario con ese correo electronico. Por favor ingresa otro.";
		
	$HTML = "warning, ERROR,".$mensaje; //Aduntar el mensaje obtenido del anterior condicional a la respuesta
	
	}

	echo $HTML;

 ?>