function mostrarAlerta(tipoAlerta, cabecera, mensaje){ //Funcion para mostrar las alertas enviadas al usuario
	if ( cabecera == undefined){

		var arrayMensaje = tipoAlerta.split(',');
		tipoAlerta = arrayMensaje[0];
		cabecera = arrayMensaje[1];
		mensaje = arrayMensaje[2];
	} 

		var result = '<div class="alert alert-dismissible alert-'+ tipoAlerta +'">';
	    result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	    result += '<h4 class="alert-heading">'+ cabecera +'</h4>';
	    result += '<p class="mb-0"><strong>'+ mensaje +'</strong></p>';
	    result += '</div>';

	    return result;
}
