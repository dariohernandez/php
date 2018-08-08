$(document).ready(function(){

	$("#btnRegCuenta").click(function(){
		if(validaRegistro()) actionRegistro();
	});
	$("#formRegCuenta").keypress(function(e){
		if(e.keyCode == 13){
		 if(validaRegistro()) actionRegistro();
		}
	});

	function validaRegistro(){
		$(".error").remove();
	    var cumple = true;
	    	 if (!$("#txtRegUsu").val().match(/^[a-z][a-z0-9_]{3,9}$/)){
	    	 	$("#txtRegUsu").focus().after("<span class='error'>Nombre de Usuario invalido</span>");
	    	 	cumple= false;
	    	 } 
	    	 if (!$("#txtRegPass").val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/)){
	    	 	$("#txtRegPass").focus().after("<span class='error'>Contraseña invalida</span>");
	    	 	cumple= false;
	    	 } 
	    	 if (!$("#txtRegCorreo").val().match(/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(\.[a-z]{2,3})$/)){
	    	 	$("#txtRegCorreo").focus().after("<span class='error'>Cuenta de correo invalida</span>");
	    	 	cumple= false;
	    	 } 
	    return cumple;
	}

	function actionRegistro(){

	var connect, form, response, result;

	//form = 'txtRegUsu ='+ $("#txtRegUsu").val() + '&txtRegPass ='+ $("#txtRegPass").val() +'&txtRegCorreo =' + $("#txtRegCorreo").val();
	form = $("#formRegCuenta").serialize();
	console.log(form);
	if($("#txtRegPass").val() != $("#txtRegPass2").val()){
        $("#ContentAJAX_Reg").html(mostrarAlerta('danger', 'ERROR', 'Las contraseñas no coinciden.'));
	} else {

		connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"); // Archivo Ajax para Explorer 6 o inferior
	connect.onreadystatechange = function(){

		if (connect.readyState == 4 && connect.status == 200){ //Archivo con respuesta y encontrado cod:200
			if (connect.responseText == 1){
	            $("#ContentAJAX_Reg").html(mostrarAlerta('success', 'Registro completado!', 'Te hemos enviado un mail para que actives tu cuenta.'));
	            window.location.reload();
	            //window.location.replace("index.php");
			} else  $("#ContentAJAX_Reg").html(mostrarAlerta(connect.responseText));

		} else if(connect.readyState != 4){	// Request sin respuesta por el servidor aun desde PHP
            $("#ContentAJAX_Reg").html(mostrarAlerta('warning', 'Procesando...', 'Estamos generando el registro.'));
		} 

	}
	connect.open('POST', 'ajax.php?mode=registro', true); //Conexion Ajax asincrona 
	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	connect.send(form);
	}


}

});