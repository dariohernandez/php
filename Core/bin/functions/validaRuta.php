<?php 
	function validaRuta($url, $rutas, $users){

		/*Retorna la sección de la URL del request posterior al ultimo '/'
		$url = substr($_SERVER['REQUEST_URI'], strripos($_SERVER['REQUEST_URI'], '/') + 1); */

		$valida = false;

			if (in_array($url, $rutas)) return true;
			elseif (!isset($_SESSION["user_id"])) return false;

		$db = new DBConexion();

		$perfil = $users[$_SESSION["user_id"]]["IDPerfil"]; // Perfil del usuario que inicia el REQUEST

		// Se obtienen todas las páginas cuyo acceso esta permitido al usuario, basado en su perfil
		$query = "SELECT paginaweb.URL FROM paginaweb INNER JOIN perfilpagina ON perfilpagina.IDPagina=paginaweb.IDPagina WHERE perfilpagina.IDPerfil=$perfil;";

		$sql = $db->ejecuta_query($query);

			if ($db->filas_afectadas($sql) > 0){

				$resultado= $db->retorna_resultado($sql);

				foreach ($resultado as $pag) {

					if (!strcmp($pag["URL"], $url)) $valida = true; // Si encuentra que la url solicitada esta dentro de las páginas habilitadas retorna TRUE
				}

			}

		$db->cerrar($sql);

		return $valida;
	}


 ?>