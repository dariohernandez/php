<?php

if ($_POST  || $_GET){

require("Core/core.php");

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'login':

			require('Core/bin/ajax/actionLogin.php');

			break;
		case 'producto':

			require('Core/bin/ajax/actionProducto.php');

			break;
		case 'registro':
			require('Core/bin/ajax/actionRegistro.php');

			break;
		case 'rcvPass':

			require('Core/bin/ajax/actionRecoverPass.php');

			break;
		
		default:
			
			header('location:index.php');

			break;
	}
} else {
	header('location:index.php');
}

?>