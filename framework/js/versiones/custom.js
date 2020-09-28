$(document).ready(function () {

    //VALIDACION DE CORREO

    function validar_correo(correo) {

        var validacion = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

        if (validacion.test(correo)) {
            return true;
        } else {
            return false;
        }
    }

    //WEB URL
    var base_url = "http://localhost/landing_yokai/";

    //_FUNCION QUE VALIDA UN RUT CON SU CADENA COMPLETA EJ: "19576832-2".
    var Fn = {
        validaRut: function (rut_completo) {
            //RECIBE UN RUT Y REEMPLAZA LOS CARACTERES.
            rut_completo = rut_completo.replace("‐", "-");
            //DETERMINA LA CODIFICACION DE QUE SI EL RUT QUE RECIBE NO ES VALIDO
            //, YA QUE TIENE UN SIGNO DE EXCLAMACION.
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rut_completo))
                return false;
            var tmp = rut_completo.split('-');
            var digv = tmp[1];
            var rut = tmp[0];
            if (digv == 'K')
                digv = 'k';
            //RETORNA UN RUT VALIDO.
            return (Fn.dv(rut) == digv);

        },
        //CODIFICACION QUE CALCULA EL DIGITO VERFICACADOR CONVIRTIENDO LA LETRA "K" EN 1.
        dv: function (T) {
            var M = 0, S = 1;
            for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11;
            return S ? S - 1 : 'k';
        }
    };

    $("#boton_contacto").click(function (excepcion) {
        excepcion.preventDefault();
        var estado, descripcion = "";
        var nombre_contacto = $("#nombre_contacto").val();
        var celular_contacto = $("#celular_contacto").val();

        if (nombre_contacto == "" || celular_contacto == "") {
            estado = "warning";
            descripcion = "Complete Campo(s) Vacio(s)";
            validar_vista(estado, descripcion);
        } else {
            $.ajax({
                url: base_url + 'boton_contacto',
                type: 'post',
                dataType: 'json',
                data: {nombre_contacto: nombre_contacto, celular_contacto: celular_contacto},
                success: function (o) {
                    estado = "info";
                    validar_vista(estado, o.mensaje);
                    $("#nombre_contacto").val("");
                    $("#celular_contacto").val("");
                    $('#boton_contacto').attr("disabled", true);
                },
                error: function () {
                    alert("Error 500");
                }
            });
        }
    });

    function validar_vista(estado, descripcion) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "4000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        },
        toastr[estado](descripcion, "¡Validación!");
    }

});