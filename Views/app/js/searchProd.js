        $(document).ready(function () {

            $('#btnBuscar').click(function () {
                var cumple = true;
                if ($("#txtBuscar").val() == "") {
                    $("#txtBuscar").addClass("campo_invalido");
                    $("#txtBuscar").attr({ "placeholder": "*Sin parametro de busqueda*" });
                    cumple = false;
                } 
                if (cumple) env_ajax('ajax.php?mode=producto', 'get', 'form_busqueda', false);
                return cumple;
            });
        });