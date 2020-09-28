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
    var base_url = "http://localhost/sofgem_api/";

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
        var telefono_contacto = $("#telefono_contacto").val();

        if (nombre_contacto == "" || telefono_contacto == "") {
            estado = "warning";
            descripcion = "Complete Campo(s) Vacio(s)";
            validar_vista(estado, descripcion);
        } else {
            $('#boton_contacto').attr("disabled", true);
            $.ajax({
                url: base_url + 'boton_contacto',
                type: 'post',
                dataType: 'json',
                data: {nombre_contacto: nombre_contacto, telefono_contacto: telefono_contacto},
                success: function (o) {
                    estado = "info";
                    validar_vista(estado, o.mensaje);
                    $("#nombre_contacto").val("");
                    $("#telefono_contacto").val("");
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

    $("#boton_iniciar_sesion").click(function (excepcion) {
        excepcion.preventDefault();
        var estado, descripcion = "";
        var rut_usuario = $("#rut_usuario").val();
        var clave_usuario = $("#clave_usuario").val();

        if (rut_usuario == "" || clave_usuario == "") {
            estado = "warning";
            descripcion = "Complete campo(s) vacio(s)";
            validar_vista(estado, descripcion);
        } else {
            if (Fn.validaRut(rut_usuario)) {
                $.ajax({
                    url: base_url + 'boton_iniciar_sesion',
                    type: 'post',
                    dataType: 'json',
                    data: {rut_usuario: rut_usuario, clave_usuario: clave_usuario},
                    success: function (o) {
                        if (o.mensaje == "0") {
                            estado = "warning";
                            descripcion = "Credenciales incorrectas";
                            validar_vista(estado, descripcion);
                            $("#rut_usuario").val("");
                            $("#clave_usuario").val("");
                        } else {
                            if (o.mensaje == "1") {
                                estado = "error";
                                descripcion = "Acceso denegado";
                                validar_vista(estado, descripcion);
                                $("#rut_usuario").val("");
                                $("#clave_usuario").val("");
                            } else {
                                estado = "success";
                                validar_vista(estado, "Bienvenido");
                                $("#rut_usuario").val("");
                                $("#clave_usuario").val("");
                                setTimeout(
                                        function ()
                                        {
                                            window.location.href = base_url + o.mensaje;
                                        }, 2500);
                            }
                        }
                    },
                    error: function () {
                        alert("Error 500");
                    }
                });
            } else {
                estado = "warning";
                descripcion = "Rut Incorrecto";
                validar_vista(estado, descripcion);
            }
        }
    });

    $("#crear_usuario").click(function (excepcion) {
        excepcion.preventDefault();

        var formulario_crear_usuario = $("#formulario_crear_usuario")[0];
        var data = new FormData(formulario_crear_usuario);

        var estado, descripcion = "";
        var id_perfil = $("#id_perfil").val();
        var rut_usuario = $("#rut_usuario").val();
        var nombre_usuario = $("#nombre_usuario").val();
        var apellido_usuario = $("#apellido_usuario").val();
        var estado_usuario = $("#estado_usuario").val();
        var correo_usuario = $("#correo_usuario").val();

        if (rut_usuario == "" || nombre_usuario == "" || apellido_usuario == "" || estado_usuario == "" || correo_usuario == "") {
            estado = "warning";
            descripcion = "Complete campo(s) vacio(s)";
            validar_vista(estado, descripcion);
        } else {
            if (Fn.validaRut(rut_usuario)) {
                if (validar_correo(correo_usuario)) {
                    if (id_perfil == 1) {
                        $.ajax({
                            url: base_url + 'crear_usuario',
                            type: 'post',
                            dataType: 'json',
                            data: data,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function (o) {
                                estado = "info";
                                validar_vista(estado, o.mensaje);
                                $("#rut_usuario").val("");
                                $("#nombre_usuario").val("");
                                $("#apellido_usuario").val("");
                                $("#correo_usuario").val("");
                                $("#telefono_usuario").val("");
                            },
                            error: function () {
                                alert("Error 500");
                            }
                        });
                    } else {
                        estado = "error";
                        descripcion = "Permisos insuficientes";
                        validar_vista(estado, descripcion);
                    }
                } else {
                    estado = "warning";
                    descripcion = "Correo erroneo";
                    validar_vista(estado, descripcion);
                }
            } else {
                estado = "warning";
                descripcion = "Rut incorrecto";
                validar_vista(estado, descripcion);
            }
        }
    });

    $("#boton_editar_usuario").click(function (excepcion) {
        excepcion.preventDefault();

        var formulario_acciones_usuario = $("#formulario_acciones_usuario")[0];
        var data = new FormData(formulario_acciones_usuario);

        var estado, descripcion = "";
        var id_perfil = $("#id_perfil").val();
        var correo_usuario = $("#correo_usuario").val();
        var estado_usuario = $("#estado_usuario").val();

        if (correo_usuario == "" || estado_usuario == "") {
            estado = "warning";
            descripcion = "Complete campo obligatorio";
            validar_vista(estado, descripcion);
        } else {
            if (validar_correo(correo_usuario)) {
                if (id_perfil == 1) {
                    $.ajax({
                        url: base_url + 'editar_usuario',
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (o) {
                            estado = "info";
                            validar_vista(estado, o.mensaje);
                            $("#modal_id_usuario").modal('hide');
                            $("#tabla_usuario").DataTable().ajax.reload();
                        },
                        error: function () {
                            alert("Error 500");
                        }
                    });
                } else {
                    estado = "error";
                    descripcion = "Permisos insuficientes";
                    validar_vista(estado, descripcion);
                }
            } else {
                estado = "warning";
                descripcion = "Correo erroneo";
                validar_vista(estado, descripcion);
            }
        }
    });


    $("#recuperar_usuario").click(function (excepcion) {
        excepcion.preventDefault();

        var formulario_recuperar_usuario = $("#formulario_recuperar_usuario")[0];
        var data = new FormData(formulario_recuperar_usuario);

        var estado, descripcion = "";
        var rut_usuario = $("#rut_usuario").val();
        var correo_usuario = $("#correo_usuario").val();

        if (rut_usuario == "" || correo_usuario == "") {
            estado = "warning";
            descripcion = "Complete campo(s) vacio(s)";
            validar_vista(estado, descripcion);
        } else {
            if (Fn.validaRut(rut_usuario)) {
                if (validar_correo(correo_usuario)) {
                    $('#recuperar_usuario').attr("disabled", true);
                    $.ajax({
                        url: base_url + 'recuperar_usuario',
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (o) {
                            estado = "info";
                            validar_vista(estado, o.mensaje);
                            $("#rut_usuario").val("");
                            $("#correo_usuario").val("");
                            $('#recuperar_usuario').attr("disabled", false);
                        },
                        error: function () {
                            alert("Error 500");
                        }
                    });
                } else {
                    estado = "warning";
                    descripcion = "Correo erroneo";
                    validar_vista(estado, descripcion);
                }
            } else {
                estado = "warning";
                descripcion = "Rut incorrecto";
                validar_vista(estado, descripcion);
            }
        }
    });

    $("#crear_contacto").click(function (excepcion) {
        excepcion.preventDefault();

        var estado, descripcion = "";
        var nombre_contacto = $("#nombre_contacto").val();
        var asunto_contacto = $("#asunto_contacto").val();
        var correo_contacto = $("#correo_contacto").val();
        var telefono_contacto = $("#telefono_contacto").val();
        var contenido_contacto = $("#contenido_contacto").val();

        if (nombre_contacto == "" || asunto_contacto == "" || correo_contacto == "" || telefono_contacto == "" || contenido_contacto == "") {
            estado = "warning";
            descripcion = "Complete Campo(s) Vacio(s)";
            validar_vista(estado, descripcion);
        } else {
            if (validar_correo(correo_contacto)) {
                $('#crear_contacto').attr("disabled", true);
                $.ajax({
                    url: base_url + "crear_contacto",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        nombre_contacto: nombre_contacto, asunto_contacto: asunto_contacto,
                        correo_contacto: correo_contacto,
                        telefono_contacto: telefono_contacto, contenido_contacto: contenido_contacto
                    },
                    success: function (o) {
                        estado = "info";
                        validar_vista(estado, o.mensaje);
                        $('#crear_contacto').attr("disabled", false);
                        $("#nombre_contacto").val();
                        $("#asunto_contacto").val();
                        $("#correo_contacto").val();
                        $("#telefono_contacto").val();
                        $("#contenido_contacto").val();
                    },
                    error: function () {
                        $('#crear_contacto').attr("disabled", false);
                        alert("Error 500");
                    }
                });
            } else {
                estado = "warning";
                descripcion = "Correo invalido";
                validar_vista(estado, descripcion);
            }
        }
    });
});