$(document).ready(function(){

	$("#formLogin").keypress(function(e){
		if(e.keyCode == 13){
		 if(validaLogin()) actionLogin();
		}
	});
	$("#btnLogin").click(function(e){

		if (validaLogin()) actionLogin();

		//e.preventDefault();
	});

});

function validaLogin(){
	var cumple = true;
	$(".error").remove();
	if($("#usuLogin").val() ==""){
		$("#usuLogin").focus().after("<span class='error'>Usuario requerido</span>");
		 cumple=false;
	}
	if($("#passLogin").val() ==""){
		$("#passLogin").focus().after("<span class='error'>Contraseña requerida</span>");
		cumple=false;
	}
	return cumple;
}

function actionLogin(){

	var connect, form, response, result;

	form = $("#formLogin").serialize();

	connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"); // Archivo Ajax para Explorer 6 o inferior
	connect.onreadystatechange = function(){

		if (connect.readyState == 4 && connect.status == 200){ //Archivo con respuesta y encontrado cod:200
			if (connect.responseText == 1){

	            $("#ContentAJAX").html(mostrarAlerta('success', 'Conectado!', 'Te estamos redireccionando a tu cuenta.'));
	            window.location.reload();
	            //window.location.replace("index.php");
			} else  {
				$("#ContentAJAX").html(mostrarAlerta(connect.responseText));
		}

		} else if(connect.readyState != 4){	// Request sin respuesta por el servidor aun desde PHP
            $("#ContentAJAX").html(mostrarAlerta('warning', 'Procesando...', 'Estamos validando tus datos de ingreso.'));
		} 

	}
	connect.open('POST', 'ajax.php?mode=login', true); //Conexion Ajax asincrona 
	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	connect.send(form);
}

