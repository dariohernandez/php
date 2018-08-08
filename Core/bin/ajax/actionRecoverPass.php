<?php 
if (isset($_POST["emailRst"])){

	$mailUser = $_POST["emailRst"];
	$nameUser= null;
	$dataUser = Usuario::existeUsuario($nameUser, $mailUser); // La función existeUsuario coteja por correo o nombre si existe determinado user. No obstante, aqui solo se validara el correo

		if (!empty($dataUser)){

			$keyRCV = md5(time());
			$link = DIR_APP .'?view=user&action=recoverPass&key='.$keyRCV;// Se genera el link que sera enviado al usuario para que reactive la contraseña
			
					$parametrosMail = array(
						"subject" => "Recuperación de contraseña",
						"body" => createMailRcvPass($dataUser->getNombreUsuario(),$link),
						"altBody" => $dataUser->getNombreUsuario().'. Para obtener una nueva contraseña para tu cuenta dirigete a '.$link.'. Si no haz iniciado esta operación omite el mensaje.'
					);

					//Llamado a la función para enviar correos, la cual retorna TRUE si se ha podido enviar o el texto del error si NO
					$response = enviaMail($dataUser->getNombreUsuario(), $mailUser, $parametrosMail);

					if ($response){
						(Usuario::createRCVPasword($dataUser->getID_Usuario(), $keyRCV)> 0)? $HTML = 1 : $HTML = "No se pudo crear la nueva contraseña";
					}

		} else $HTML = "error, ERROR:, El mail introducido no existe en el sistema";


		echo $HTML;

} else header('location: ?view=index')

 ?>