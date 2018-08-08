$(document).ready(function(){

$("#btnBuscarDel").click(function(){
		$(".error").remove();
	    var cumple = true;
	    	 if ($("#txtDelCod").val() <= 0){
	    	 	$("#txtDelCod").focus().after("<span class='error'>Valor invalido</span>");
	    	 	cumple= false;
	    	 } 
	    if (cumple) env_ajax('ajax.php?mode=producto', 'post', 'form_prodDel',false);
	    return cumple;
	});

/*$(document).on('click','#btnAceptDelProd',function(event){
	env_ajax('ajax.php?mode=producto', 'post', 'form_prodDel1',false);
}) ---> Metodo necesario en algunas ocasiones cuando la parte HTML es cargada por AJAX. No obstante para el caso se incluye el envento CLICK en la etiqueta*/ 

$(document).on('click','#btnBuscarUpd',function(event){
	$(".error").remove();
	    var cumple = true;
	    	 if ($("#txtUpdCod").val() <= 0){
	    	 	$("#txtUpdCod").focus().after("<span class='error'>Valor invalido</span>");
	    	 	cumple= false;
	    	 } 
	    	if (cumple) env_ajax('ajax.php?mode=producto', 'post', 'form_prodUpd', false);
	    return cumple;
})

$(document).on('click','#btnGuardarUpd',function(event){
	$(".error").remove();
                var cumple = true;
                if ($("#txtProdUpd").val() == "") {
                    $("#txtProdUpd").focus().after("<span class='error'>Nombre de producto requerido</span>");
                    cumple = false;
                    
                }
                if ($("#txtDescProdUpd").val() == "") {
                    $("#txtDescProdUpd").focus().after("<span class='error'>Descripción requerida</span>");
                    cumple = false;
    
                }
            
                if (isNaN($("#txtPrecioProdUpd").val()) || $("#txtPrecioProdUpd").val() <= 0) {
                    $("#txtPrecioProdUpd").focus().after("<span class='error'>Valor invalido</span>");
                    cumple = false;
                }
				if(cumple) env_ajax('ajax.php?mode=producto', 'post', 'form_prodUpd1', true);

			return cumple;
})

/*function valida_preAjax(){


	// Validar los campos de formulario antes de enviar
                $(".error").remove();
                var cumple = true;
                if ($("#txtProdUpd").val() == "") {
                    $("#txtProdUpd").focus().after("<span class='error'>Nombre de producto requerido</span>");
                    cumple = false;
                    
                }
                if ($("#txtDescProdUpd").val() == "") {
                    $("#txtDescProdUpd").focus().after("<span class='error'>Descripción requerida</span>");
                    cumple = false;
    
                }
            
                if (isNaN($("#txtPrecioProdUpd").val()) || $("#txtPrecioProdUpd").val() <= 0) {
                    $("#txtPrecioProdUpd").focus().after("<span class='error'>Valor invalido</span>");
                    cumple = false;
                }
				if(cumple) env_ajax('productoUpd.php', 'post', 'form_prodUpd1', false);

			return cumple;

}*/


});
