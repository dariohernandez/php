$(document).ready(function(){

	$("#formResetPass").keypress(function(e){
		if(e.keyCode == 13){
		 	if (validaRcvPass()) actionRcvPass();
		 	else return false; 	
		}
	});
	$("#btnRecover").click(function(e){

		if (validaRcvPass()) actionRcvPass();

		//e.preventDefault();
	});

function validaRcvPass(){
	var cumple = true;
	$(".error").remove();
	if(!$("#emailRst").val().match(/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(\.[a-z]{2,3})$/)){
		$("#btnRecover").focus().before("<div><span class='error'>Email no valido</span></div>");
		 cumple=false;
	}
	return cumple;
}

function actionRcvPass(){

	var connect, form, response, result;

	form = $("#formResetPass").serialize();

	connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"); // Archivo Ajax para Explorer 6 o inferior
	connect.onreadystatechange = function(){

		if (connect.readyState == 4 && connect.status == 200){ //Archivo con respuesta y encontrado cod:200
			if (connect.responseText == 1){

	            $("#ContentAJAX_RcvPass").html(mostrarAlerta('success', 'Clave generada!', 'Se ha enviado un mail con la nueva contraseña.'));
	            window.location.reload();
	            //window.location.replace("index.php");
			} else  {
				$("#ContentAJAX_RcvPass").html(mostrarAlerta(connect.responseText));
		}

		} else if(connect.readyState != 4){	// Request sin respuesta por el servidor aun desde PHP
            $("#ContentAJAX_RcvPass").html(mostrarAlerta('warning', 'Procesando...', 'Estamos procesando la solicitud.'));
		} 

	}
	connect.open('POST', 'ajax.php?mode=rcvPass', true); //Conexion Ajax asincrona 
	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	connect.send(form);
}
});
