<?php $usuario = $this->session->userdata("administrador"); ?>
<div class="site-section bg-light">
    <form id="formulario_crear_blog" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <br>
                    <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Crear Blog</b></h2>
                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $usuario[0]->id_usuario; ?>" readonly="true">
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="titulo_blog">Título:</label>
                        <input type="text" class="form-control" id="titulo_blog" name="titulo_blog" placeholder="SofGem Crece" maxlength="45" style="border-color: #8bc34a">
                    </div>
                    <div class="form-group">
                        <label for="sub_titulo_blog">Sub Título:</label>
                        <textarea rows="5" placeholder="Descripción breve de la noticia." class="form-control" name="sub_titulo_blog" id="sub_titulo_blog" maxlength="175" style="resize: none; border-color: #8bc34a"></textarea>	
                    </div>
                    <div class="form-group">
                        <label for="imagen_principal_blog">Adjunte imagen de noticia (jpeg, jpg, png)</label>
                        <input type="file" class="form-control-file" id="imagen_principal_blog" name="imagen_principal_blog">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="autor_blog">Autor:</label>
                        <input type="text" class="form-control" id="autor_blog" name="autor_blog" readonly="trur" maxlength="45" style="border-color: #8bc34a" value="<?php echo $usuario[0]->nombre_usuario . ' ' . $usuario[0]->apellido_usuario; ?>">
                    </div>
                    <div class="form-group">
                        <label for="contenido_blog">Contenido:</label>
                        <textarea rows="5" placeholder="Descripción detallada de la noticia." class="form-control" name="contenido_blog" id="contenido_blog" maxlength="100000" style="resize: none; border-color: #8bc34a"></textarea>	
                    </div>
                </div>
                <div class="col-md-12 col-lg-12" style="text-align: center">
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-success btn-md text-white" id="crear_blog">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $("#crear_blog").click(function (excepcion) {
            excepcion.preventDefault();

            var formulario_crear_blog = $("#formulario_crear_blog")[0];
            var data = new FormData(formulario_crear_blog);

            var estado, descripcion = "";
            var titulo_blog = $("#titulo_blog").val();
            var sub_titulo_blog = $("#sub_titulo_blog").val();
            var autor_blog = $("#autor_blog").val();
            var contenido_blog = $("#contenido_blog").val();
            var imagen_principal_blog = $("#imagen_principal_blog")[0].files[0];

            if (titulo_blog == "" || sub_titulo_blog == "" || autor_blog == "" || contenido_blog == "") {
                estado = "warning";
                descripcion = "Complete Campo(s) Vacio(s)";
                validar_vista(estado, descripcion);
            } else {
                if (imagen_principal_blog != null) {
                    $('#crear_blog').attr("disabled", true);
                    $.ajax({
                        url: base_url + 'crear_blog',
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
                            $('#crear_blog').attr("disabled", false);
                            $("#titulo_blog").val("");
                            $("#sub_titulo_blog").val("");
                            $("#contenido_blog").val("");
                            $("#imagen_principal_blog").val("");
                        },
                        error: function () {
                            $('#crear_blog').attr("disabled", false);
                            alert("Error 500");
                        }
                    });
                } else {
                    estado = "warning";
                    descripcion = "Ingrese una imagen (jpeg, jpg, png)";
                    validar_vista(estado, descripcion);
                }
            }
        });
    });
</script>