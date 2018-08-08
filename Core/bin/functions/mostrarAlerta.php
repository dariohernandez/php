<?php 

	function mostrarAlerta($tipoAlerta, $cabecera, $mensaje){

		$result = '<div class="alert alert-dismissible alert-'.$tipoAlerta.'">';
	    $result .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	    $result .= '<h4 class="alert-heading">'.$cabecera.'</h4>';
	    $result .= '<p class="mb-0"><strong>'.$mensaje.'</strong></p>';
	    $result .= '</div>';

	    return $result;
	}
 ?>
