    $(document).ready(function(){
            $("#btnGuardar").click(function(){
                // Validar los campos de formulario antes de enviar
                $(".error").remove();
                var cumple = true;
                if ($("#txtNombreProd").val() == "") {
                    $("#txtNombreProd").focus().after("<span class='error'>Nombre de producto requerido</span>");
                    cumple = false;
                    
                }
                if ($("#txtDescProd").val() == "") {
                    $("#txtDescProd").focus().after("<span class='error'>Descripción requerida</span>");
                    cumple = false;
    
                }
            
                if (isNaN($("#txtPrecioProd").val()) || $("#txtPrecioProd").val() <= 0) {
                    $("#txtPrecioProd").focus().after("<span class='error'>Valor invalido</span>");
                    cumple = false;
                }
                if ($("#imagen").val() == "") {
                    $("#imagen").focus().after("<span class='error'>Sin imagen seleccionada</span>");
                    cumple = false;
                }else {
                    var archivo = $("#imagen").val();
                    var extValida = new Array(".gif", ".jpg", ".png");
                    var ext = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
                    var valido = false;
                    for (var i = 0; i < extValida.length; i++) {
                        if (extValida[i] == ext) {
                            valido = true;
                            break;
                        }
                    }
                    if (!valido) {
                        $("#imagen").focus().after("<span class='error'>Archivo de imagen invalido</span>");
                        cumple = false;
                    }

                }
                if (cumple) env_ajax('ajax.php?mode=producto', 'post', 'form_AddProd',true);
                return cumple;

              });
});