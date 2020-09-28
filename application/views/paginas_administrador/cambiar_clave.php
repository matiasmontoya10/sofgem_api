<?php $usuario = $this->session->userdata("administrador"); ?>
<div class="site-section bg-light">
    <form id="formulario_cambiar_clave" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <br>
                    <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Cambiar Clave</b></h2>
                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $usuario[0]->id_usuario; ?>" readonly="true">
                    <input type="hidden" id="clave_usuario" name="clave_usuario" value="<?php echo $usuario[0]->clave_usuario; ?>" readonly="true">
                    <input type="hidden" id="rut_usuario" name="rut_usuario" value="<?php echo $usuario[0]->rut_usuario; ?>" readonly="true">
                    <input type="hidden" id="correo_usuario" name="correo_usuario" value="<?php echo $usuario[0]->correo_usuario; ?>" readonly="true">
                    <br>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="clave_actual">Ingrese clave actual:</label>
                        <input type="password" class="form-control" id="clave_actual" name="clave_actual" placeholder="******" maxlength="10" style="border-color: #78AD39">
                    </div>
                    <div class="form-group">
                        <label for="clave_nueva">Ingrese clave nueva:</label>
                        <input type="password" class="form-control" id="clave_nueva" name="clave_nueva" placeholder="******" maxlength="10" style="border-color: #78AD39">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="clave_repetir">Repetir clave nueva:</label>
                        <input type="password" class="form-control" id="clave_repetir" name="clave_repetir" placeholder="******" maxlength="10" style="border-color: #78AD39">
                    </div>
                </div>
                <div class="col-md-12 col-lg-12" style="text-align: center">
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-success btn-md text-white" id="cambiar_clave">Cambiar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
<script>
    $(document).ready(function () {
        $("#cambiar_clave").click(function (excepcion) {
            excepcion.preventDefault();

            var formulario_cambiar_clave = $("#formulario_cambiar_clave")[0];
            var data = new FormData(formulario_cambiar_clave);

            var estado, descripcion = "";
            var clave_usuario = $("#clave_usuario").val();
            var clave_actual = $("#clave_actual").val();
            var md5_clave_actual = CryptoJS.MD5(clave_actual).toString();
            var clave_nueva = $("#clave_nueva").val();
            var clave_repetir = $("#clave_repetir").val();

            if (clave_actual == "" || clave_nueva == "" || clave_repetir == "") {
                estado = "warning";
                descripcion = "Complete Campo(s) Vacio(s)";
                validar_vista(estado, descripcion);
            } else {
                if (clave_usuario == md5_clave_actual) {
                    if (clave_nueva == clave_repetir) {
                        if (clave_nueva.length >= 4) {
                            $('#cambiar_clave').attr("disabled", true);
                            $.ajax({
                                url: base_url + 'cambiar_clave',
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
                                    $("#clave_actual").val("");
                                    $("#clave_nueva").val("");
                                    $("#clave_repetir").val("");
                                    $('#cambiar_clave').attr("disabled", false);
                                    setTimeout(
                                            function ()
                                            {
                                                window.location.href = base_url + 'cliente/iniciar';
                                            }, 2000);
                                },
                                error: function () {
                                    alert("Error 500");
                                }
                            });
                        } else {
                            estado = "warning";
                            descripcion = "Clave nueva minimo de 4 caracteres";
                            validar_vista(estado, descripcion);
                        }
                    } else {
                        estado = "warning";
                        descripcion = "Clave nueva no coincide";
                        validar_vista(estado, descripcion);
                    }
                } else {
                    estado = "warning";
                    descripcion = "Clave actual incorrecta";
                    validar_vista(estado, descripcion);
                }
            }
        });
    });
</script>