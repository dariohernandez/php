function paginadorGET(pag){
	var data;
	if($("#txtBuscar").val() != "")
		data = {
			txtBuscar : $("#txtBuscar").val(),
			pagina: pag
		};
		else data = { pagina: pag };
	$.get("productosSelect.php", data, function(retorno){
   	$('#content_dinamico').html(retorno);
});

}