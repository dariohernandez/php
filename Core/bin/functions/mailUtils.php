<?php
//Utilidades de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function createMailRegistro($user, $link){
	
	$HTML= '<html>
				<body>
				<h2>Hola '.$user.'</h2>
				<p>¡Gracias por registrarte en '.NOMB_APP.'!<p>
				<p class="activacionCta">Para activar tu cuenta personal haz click <a class="linkAct" href="'.$link.'" target="_blank" >> > aqui < <<a></p> 	
				</body>
			</html>';
			
	return $HTML;
}

function createMailRcvPass($user, $link){
	
	$HTML= '<html>
				<body>
				<h2>'.$user.'</h2>
				<p class="activacionCta">Para poder generar una nueva contraseña en <strong>'.NOMB_APP.'</strong> haz click <a class="linkAct" href="'.$link.'" target="_blank" >> > aqui < <<a></p> 	
				<p class="activacionCta"> Si no haz solicitado reactivación de contraseña omite el mensaje.</p>
				</body>
			</html>';
			
	return $HTML;
}

function enviaMail($userName, $userMail, $parametros){

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		$mail -> CharSet = "UTF-8";
			try {
				//Server settings
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = SMTP_EMAIL;                 // SMTP username
				$mail->Password = SMTP_PASS;                           // SMTP password
				$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = SMTP_PORT;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom(SMTP_EMAIL, NOMB_APP);			// Direccion desde donde se envia
				$mail->addAddress($userMail, $userName);     // Destinatario del correo


				//Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = $parametros["subject"];
				$mail->Body    = $parametros["body"];
				$mail->AltBody = $parametros["altBody"];

				if ($mail->send()) $response = true;
				
			} catch (Exception $e) {
				$response= 'danger, ERROR:, El mensaje no hay sido enviado. Mailer Error: '. $mail->ErrorInfo;
			}
	return $response;
}


?>