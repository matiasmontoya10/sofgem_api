<?php $usuario = $this->session->userdata("administrador"); ?>
<div class="site-section bg-light">
    <form id="formulario_cambiar_datos" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <br>
                    <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Actualizar Datos</b></h2>
                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $usuario[0]->id_usuario; ?>" readonly="true">
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="telefono_usuario">Teléfono:<b> (Opcional)</b></label>
                        <input type="text" class="form-control validar_numero" id="telefono_usuario" name="telefono_usuario" placeholder="983006194" maxlength="9" style="border-color: #8bc34a">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="correo_usuario">Correo:</label>
                        <input type="text" class="form-control" id="correo_usuario" name="correo_usuario" placeholder="mmontoya@sofgem.cl" maxlength="50" style="border-color: #8bc34a" readonly="true">
                    </div>
                </div>
                <div class="col-md-12 col-lg-12" style="text-align: center">
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-success btn-md text-white" id="boton_cambiar_datos">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {

        buscar_datos();

        function validar_correo(correo) {

            var validacion = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

            if (validacion.test(correo)) {
                return true;
            } else {
                return false;
            }
        }

        function buscar_datos() {
            $.ajax({
                url: base_url + "id_panel_usuario",
                type: 'post',
                dataType: 'json',
                data: {id_usuario: id_usuario_php},
                success: function (result) {
                    $.each(result, function (i, o) {
                        $("#telefono_usuario").val(o.telefono_usuario);
                        $("#correo_usuario").val(o.correo_usuario);
                    });
                },
                error: function () {
                    alert('Error 500');
                }
            });
        }

        $('.validar_numero').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $("#boton_cambiar_datos").click(function (excepcion) {
            excepcion.preventDefault();

            var formulario_cambiar_datos = $("#formulario_cambiar_datos")[0];
            var data = new FormData(formulario_cambiar_datos);

            var estado, descripcion = "";
            var correo_usuario = $("#correo_usuario").val();

            if (correo_usuario == "") {
                estado = "warning";
                descripcion = "Complete campo obligatorio";
                validar_vista(estado, descripcion);
            } else {
                if (validar_correo(correo_usuario)) {
                    $.ajax({
                        url: base_url + 'cambiar_datos_usuario',
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (resultado) {
                            buscar_datos();
                            estado = "info";
                            validar_vista(estado, resultado.mensaje);
                            $('#boton_cambiar_datos').attr("disabled", true);
                        },
                        error: function () {
                            alert("Error 500");
                        }
                    });
                } else {
                    estado = "warning";
                    descripcion = "Correo incorrecto";
                    validar_vista(estado, descripcion);
                }
            }
        });
    });
</script>