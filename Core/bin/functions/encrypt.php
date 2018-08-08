<?php

function encriptar($cadena){

	$str = '';
	for ($i=0; $i< strlen($cadena); $i++){

		$str .= ($i % 2) != 0 ? md5($cadena[$i]) : $i;
	}

	return md5($str);
}

?>