<?php 

function call_controller($controller, $action){
		
		require_once("Core/controllers/".$controller."Controller.php"); // si incorpora la funcionalidad del controlador

		$controllerName = ucwords($controller) ."Controller";

		if (class_exists($controllerName)) {	//Validar si existe una clase controladora. Para algunas funcionalidades basicas no ha sido creada
    	
	    	$controller = new $controllerName; // Crear objeto de la clase controladora

			$controller->{$action}(); //Llamada al metodo correspondiente a la acción
		}
			
}

$url_request = "?view=".$controller."&action=".$action; // se completa la URL con los parametros de ingreso. Por si se diera el caso de que la URL del REQUEST tenga algún dato omitido

if (!validaRuta($url_request, $rutas_publicas, $users)) header('location:?view=home');

//echo validaRuta($controller,$action, $rutas_publicas);

if(array_key_exists($controller, $controllers)){ // Buscar si existe el controlador en el listado de controllers validos
	
	// Valida si la operación solicitada existe
	if (in_array($action, $controllers[$controller])) call_controller($controller,$action);
	else call_controller($controller, 'error');

} else header('location: ?view=error');




 ?>
