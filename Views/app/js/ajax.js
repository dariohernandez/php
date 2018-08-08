//Funcion que define la informacion y los parametros para realizar una llamada a la funcionalidad de ajax
function env_ajax(url, method, idForm, imagen){
	event.preventDefault();
    var data, selector= '#' + idForm;
    if (method == 'get') data = $(selector).serialize();
    else {
    data = new FormData();
    var data_form = $(selector).serializeArray();
        $.each(data_form,function(key,input){
            data.append(input.name,input.value);
        });
            if (imagen){
                $.each($('input[type=file]')[0].files, function(i, file) {
                data.append('imagen-'+i, file);
                });
            }
    }
	$.ajax({
                data:  data, //datos que se envian a traves de ajax serializados
                url:   url, //archivo que recibe la peticion
                type:  'html', //método de envio
                method: method,
                cache: false,
                contentType: false,
                processData: false,
                error: function(){ alert("error petición ajax");
                },
                success:  function (mensaje) {
                //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $('#content_dinamico').html(mensaje);
                }
      });
}