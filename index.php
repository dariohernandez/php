<?php

require("Core/core.php");

$controller ="home";	// Definimos el controlador que mostrata el contenido dinamico de la página
$action = "index";

if(isset($_GET["view"])) {

	$controller = $_GET["view"];

	if (isset($_GET["action"]))	$action = $_GET["action"];
}

if (!strcmp($controller, 'error')) require_once("Core/controllers/errorController.php");
else require_once("Core/controllers/masterController.php");

?>