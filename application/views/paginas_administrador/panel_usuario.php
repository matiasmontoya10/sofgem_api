<?php $usuario = $this->session->userdata("administrador"); ?>
<div id="modal_id_usuario" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body borde_card_panel" style="background-color: #212121">
                <form class="p-2" id="formulario_acciones_usuario" method="post" enctype="multipart/form-data" >
                    <h4 class="text-white mb-5" style="text-align: center">Adm. de Blog's</h4> 
                    <input type="hidden" id="id_usuario" name="id_usuario">
                    <input type="hidden" id="id_perfil" name="id_perfil" value="<?php echo $usuario[0]->id_perfil; ?>">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="text-white" for="rut_usuario">Rut:</label>
                            <input type="text" name="rut_usuario" id="rut_usuario" class="form-control" style="border-color: #9b9b9b" maxlength="45" readonly="true">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="nombre_completo_usuario">Nombre:</label>
                            <input type="text" id="nombre_completo_usuario" name="nombre_completo_usuario" class="form-control" style="border-color: #9b9b9b" maxlength="45" readonly="true">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="telefono_usuario">Teléfono:<b> (Opcional)</b></label>
                            <input type="text" name="telefono_usuario" id="telefono_usuario" class="form-control validar_numero" style="border-color: #9b9b9b" maxlength="9">
                        </div>
                        <div class="col-md-6">
                            <label for="correo_usuario" class="text-white">Correo:</label>
                            <input type="text" name="correo_usuario" id="correo_usuario" class="form-control" style="border-color: #9b9b9b" maxlength="45" readonly="true">
                        </div>
                        <div class="col-md-6">
                            <label for="nombre_perfil" class="text-white">Estado Actual:</label>
                            <input type="text" name="nombre_perfil" id="nombre_perfil" class="form-control" style="border-color: #9b9b9b" maxlength="45" readonly="true">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="color: white">
                                <label for="estado_usuario">Estado Perfil:</label>
                                <select class="form-control" id="estado_usuario" name="estado_usuario" style="border-color: #9b9b9b">
                                    <option value="1">Super Administrador</option>
                                    <option value="3">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row form-group" style="text-align: center">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info btn-md text-white" id="boton_editar_usuario">Editar</button>
                            <br><br>
                        </div>
                        <div class="col-md-6">
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
                <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Adm. de Usuarios</b></h2>
                <br>
                <table id="tabla_usuario" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>NOMBRE</th>
                            <th>TELÉFONO</th>
                            <th>CORREO</th>
                            <th>PERFIL</th>
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

        $('.validar_numero').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('#tabla_usuario').DataTable({
            scrollX: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "ajax": {
                url: base_url + "tabla_usuario",
                type: 'post',
                data: {rut_usuario: rut_usuario_php}
            },
            "iDisplayLength": 5,
            "bJQueryUI": false,
            "dom": 'Bfrtip',
            "columnDefs": [
                {"orderable": false, "targets": 1},
                {"orderable": false, "targets": 2},
                {"orderable": false, "targets": 3},
                {"orderable": false, "targets": 4},
                {"orderable": false, "targets": 6},
                {targets: [6],
                    "defaultContent": '<button id="boton_acciones_usuario" class="btn btn-success" type="submit"><i class="fa fa-edit"></i></button>'
                }
            ],
            "buttons": [
                {
                    title: 'SofGem | Usuarios',
                    messageTop: 'Listado de Usuarios.',
                    filename: 'Usuarios',
                    extend: 'pdfHtml5',
                    download: 'open',
                    pageSize: 'letter',
                    orientation: 'vertical',
                    customize: function (doc) {
                        doc.styles.tableBodyEven.alignment = 'center';
                        doc.styles.tableBodyOdd.alignment = 'center';
                        doc.styles.tableHeader.alignment = 'center';
                    },
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                }
            ],
            "lengthChange": false,
            "order": [[0, "desc"]],
            "info": false
        });

        $("body").on("click", "#boton_acciones_usuario", function (excepcion) {
            excepcion.preventDefault();
            var id_panel_usuario = $(this).parent().parent().children()[0];
            var id_usuario = $(id_panel_usuario).text();

            $.ajax({
                url: base_url + "id_panel_usuario",
                type: 'post',
                dataType: 'json',
                data: {id_usuario: id_usuario},
                success: function (result) {
                    $.each(result, function (i, o) {
                        $("#id_usuario").val(o.id_usuario);
                        $("#rut_usuario").val(o.rut_usuario);
                        $("#nombre_completo_usuario").val(o.nombre_completo_usuario);
                        $("#telefono_usuario").val(o.telefono_usuario);
                        $("#correo_usuario").val(o.correo_usuario);
                        $("#nombre_perfil").val(o.nombre_perfil);
                        $("#modal_id_usuario").modal('show');
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