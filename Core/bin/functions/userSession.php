<?php 

function getUsers(){

$base= new DBConexion();
	
	$users= false;
	if ($sql_statement = $base->ejecuta_query("SELECT * FROM usuario;")){

		if ($base->filas_afectadas($sql_statement)> 0){
			$resultado =$base->retorna_resultado($sql_statement);
			
			foreach( $resultado as $usu){

				$users[$usu['ID_Usuario']] = array(
					'ID_Usuario' => $usu['ID_Usuario'],
					'NombreUsuario' => $usu['NombreUsuario'],
					'CorreoElectronico' => $usu['CorreoElectronico'],
					'IDPerfil' => $usu['IDPerfil']
					);
			}
		}
	}

return $users;
}

 ?>