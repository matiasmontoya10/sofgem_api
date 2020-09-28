<div id="modal_id_blog" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body borde_card_panel" style="background-image: url(<?php echo base_url(); ?>framework/imagenes/confianza.jpg);">
                <form class="p-2" id="formulario_acciones_blog" method="post" enctype="multipart/form-data" >
                    <h4 class="text-white mb-5" style="text-align: center">Adm. de Blog's</h4> 
                    <input type="hidden" id="id_usuario" name="id_usuario">
                    <input type="hidden" id="id_blog" name="id_blog">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="text-white" for="fecha_blog">Fecha publicación:</label>
                            <input class="form-control" type="date" name="fecha_blog" id="fecha_blog">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="autor_blog">Autor:</label>
                            <input type="text" id="autor_blog" name="autor_blog" class="form-control" style="border-color: #8bc34a" maxlength="45" readonly="true">
                        </div>
                        <div class="col-md-12">
                            <label class="text-white" for="titulo_blog">Título:</label>
                            <input type="text" id="titulo_blog" name="titulo_blog" class="form-control" style="border-color: #8bc34a" maxlength="45">
                        </div>
                        <div class="col-md-12">
                            <label for="sub_titulo_blog" class="text-white">Sub título:</label>
                            <textarea rows="5" placeholder="Descripción detallada de la noticia." class="form-control" name="sub_titulo_blog" id="sub_titulo_blog" maxlength="195" style="resize: none; border-color: #8bc34a"></textarea>	
                        </div>
                        <div class="col-md-12">
                            <label for="contenido_blog" class="text-white">Contenido:</label>
                            <textarea rows="5" placeholder="Descripción detallada de la noticia." class="form-control" name="contenido_blog" id="contenido_blog" maxlength="100000" style="resize: none; border-color: #8bc34a"></textarea>	
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-center" style="color: white">
                                <p style="color: white">¿Cambiará imagen?</p>
                                <label class="radio-inline"></label>
                                <input type="radio" name="estado_imagen" id="no" value="no" checked="true"> No
                                <label class="radio-inline"></label>
                                <input type="radio" name="estado_imagen" id="si" value="si"> Sí
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="color: white">
                                <label for="imagen_principal_blog" style="color: white">Adjunte imagen de noticia (jpeg, jpg, png)</label>
                                <input type="file" class="form-control-file" id="imagen_principal_blog" name="imagen_principal_blog">
                            </div>	
                        </div>
                    </div>
                    <br>
                    <div class="row form-group" style="text-align: center">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-danger btn-md text-white" id="boton_eliminar_blog">Eliminar</button>
                            <br><br>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info btn-md text-white" id="boton_editar_blog">Editar</button>
                            <br><br>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-light btn-md text-black" data-dismiss="modal">Salir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-12 text-center">
                <br>
                <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Adm. de Blog's</b></h2>
                <br>
                <table id="tabla_blog" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TÍTULO</th>
                            <th>AUTOR</th>
                            <th>FECHA BLOG</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#tabla_blog').DataTable({
            scrollX: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "ajax": {
                url: base_url + "tabla_blog",
                type: 'post'
            },
            "iDisplayLength": 5,
            "bJQueryUI": false,
            "columnDefs": [
                {"orderable": false, "targets": 1},
                {"orderable": false, "targets": 2},
                {"orderable": false, "targets": 4},
                {targets: [4],
                    "defaultContent": '<button id="boton_acciones_blog" class="btn btn-success" type="submit"><i class="fa fa-edit"></i></button>'
                }
            ],
            "lengthChange": false,
            "order": [[3, "desc"]],
            "info": false
        });

        $("body").on("click", "#boton_acciones_blog", function (excepcion) {
            excepcion.preventDefault();
            var id_blog_tabla = $(this).parent().parent().children()[0];
            var id_blog = $(id_blog_tabla).text();

            $.ajax({
                url: base_url + "id_blog_tabla",
                type: 'post',
                dataType: 'json',
                data: {id_blog: id_blog},
                success: function (result) {
                    $.each(result, function (i, o) {
                        $("#id_blog").val(o.id_blog);
                        $("#titulo_blog").val(o.titulo_blog);
                        $("#autor_blog").val(o.autor_blog);
                        $("#fecha_blog").val(o.fecha_blog);
                        $("#sub_titulo_blog").val(o.sub_titulo_blog);
                        $("#contenido_blog").val(o.contenido_blog);
                        $("#id_usuario").val(o.id_usuario);
                        $("#modal_id_blog").modal('show');
                    });
                },
                error: function () {
                    alert('Error 500');
                }
            });
        });

        $("#boton_eliminar_blog").click(function (excepcion) {
            excepcion.preventDefault();
            var estado = "";
            var id_usuario = id_usuario_php;
            var id_perfil = id_perfil_php;
            var id_usuario_blog = $("#id_usuario").val();
            var id_blog = $("#id_blog").val();

            if (id_usuario == id_usuario_blog) {
                $.ajax({
                    url: base_url + 'eliminar_blog',
                    type: 'post',
                    dataType: 'json',
                    data: {id_blog: id_blog},
                    success: function (resultado) {
                        estado = "info";
                        validar_vista(estado, resultado.mensaje);
                        $("#modal_id_blog").modal('hide');
                        $("#tabla_blog").DataTable().ajax.reload();
                    },
                    error: function () {
                        alert("Error 500");
                    }
                });
            } else {
                if (id_perfil == 1) {
                    $.ajax({
                        url: base_url + 'eliminar_blog',
                        type: 'post',
                        dataType: 'json',
                        data: {id_blog: id_blog},
                        success: function (resultado) {
                            estado = "info";
                            validar_vista(estado, resultado.mensaje);
                            $("#modal_id_blog").modal('hide');
                            $("#tabla_blog").DataTable().ajax.reload();
                        },
                        error: function () {
                            alert("Error 500");
                        }
                    });
                } else {
                    estado = "warning";
                    validar_vista(estado, "No eres propietario de este blog");
                }
            }
        });

        $("#boton_editar_blog").click(function (excepcion) {
            excepcion.preventDefault();
            var formulario_acciones_blog = $("#formulario_acciones_blog")[0];
            var data = new FormData(formulario_acciones_blog);

            var estado, descripcion = "";
            var titulo_blog = $("#titulo_blog").val();
            var sub_titulo_blog = $("#sub_titulo_blog").val();
            var autor_blog = $("#autor_blog").val();
            var fecha_blog = $("#fecha_blog").val();
            var contenido_blog = $("#contenido_blog").val();
            var imagen_principal_blog = $("#imagen_principal_blog")[0].files[0];
            var id_blog = $("#id_blog").val();

            if (titulo_blog == "" || sub_titulo_blog == "" || autor_blog == "" || fecha_blog == "" || contenido_blog == "" || id_blog == "") {
                estado = "warning";
                descripcion = "Complete Campo(s) Vacio(s)";
                validar_vista(estado, descripcion);
            } else {
                if ($("#si").is(':checked')) {
                    if (imagen_principal_blog != null) {
                        $.ajax({
                            url: base_url + 'editar_blog_imagen',
                            type: 'post',
                            dataType: 'json',
                            data: data,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function (resultado) {
                                estado = "info";
                                validar_vista(estado, resultado.mensaje);
                                $("#imagen_principal_blog").val("");
                                $("#modal_id_blog").modal('hide');
                                $("#tabla_blog").DataTable().ajax.reload();
                            },
                            error: function () {
                                alert("Error 500");
                            }
                        });
                    } else {
                        estado = "warning";
                        descripcion = "Ingrese una imagen (jpeg, jpg, png)";
                        validar_vista(estado, descripcion);
                    }
                } else {
                    $.ajax({
                        url: base_url + 'editar_blog',
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (resultado) {
                            estado = "info";
                            validar_vista(estado, resultado.mensaje);
                            $("#imagen_principal_blog").val("");
                            $("#modal_id_blog").modal('hide');
                            $("#tabla_blog").DataTable().ajax.reload();
                        },
                        error: function () {
                            alert("Error 500");
                        }
                    });
                }
            }
        });
    });
</script>