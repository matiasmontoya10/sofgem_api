<!--<div id="modal_id_contacto" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body borde_card_panel" style="background-color: #212121">
                <form class="p-2" id="formulario_contacto_tributario" method="post" enctype="multipart/form-data" >
                    <h4 class="text-white mb-5" style="text-align: center">Contacto Tributario</h4> 
                    <input type="hidden" id="id_form_contacto" name="id_contacto">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-white" for="razon_social_contacto">Razón Social:</label>
                            <input type="text" id="razon_social_contacto" name="razon_social_contacto" class="form-control"  readonly="true" style="border-color: #9b9b9b">
                        </div>
                        <div class="col-md-12">
                            <label for="giro_contacto" class="text-white">Sub título:</label>
                            <textarea rows="3"class="form-control" name="giro_contacto" id="giro_contacto" style="border-color: #9b9b9b; resize: none" readonly="true"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="rut_empresa_contacto">RUT Empresa:</label>
                            <input type="text" id="rut_empresa_contacto" name="rut_empresa_contacto" class="form-control" readonly="true" style="border-color: #9b9b9b">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="direccion_contacto">Dirección:</label>
                            <input type="text" id="direccion_contacto" name="direccion_contacto" class="form-control"readonly="true" style="border-color: #9b9b9b">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="localidad_contacto">Localidad:</label>
                            <input type="text" id="localidad_contacto" name="localidad_contacto" class="form-control"  readonly="true" style="border-color: #9b9b9b">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="correo_contacto">Correo:</label>
                            <input type="text" id="correo_contacto" name="correo_contacto" class="form-control"  readonly="true" style="border-color: #9b9b9b">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="telefono_contacto">Telefono:</label>
                            <input type="text" id="telefono_contacto" name="telefono_contacto" class="form-control"  readonly="true" style="border-color: #9b9b9b">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="nombre_representante_contacto">Nombre Representante:</label>
                            <input type="text" id="nombre_representante_contacto" name="nombre_representante_contacto" class="form-control"  readonly="true" style="border-color: #9b9b9b">
                        </div>
                        <div class="col-md-6">
                            <label class="text-white" for="rut_representante_contacto">RUN Representante:</label>
                            <input type="text" id="rut_representante_contacto" name="rut_representante_contacto" class="form-control"  readonly="true" style="border-color: #9b9b9b">
                        </div>
                        <div class="col-md-12" style="text-align: right">
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-light btn-md text-black" data-dismiss="modal">Salir</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>-->
<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-12 text-center">
                <br>
                <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Contacto Tributario</b></h2>
                <br>
                <table id="tabla_form_contacto" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RAZÓN SOCIAL</th>
                            <th>RUT EMP.</th>
                            <th>DIRECCIÓN</th>
                            <th>LOCALIDAD</th>
                            <th>GIRO</th>
                            <th>CORREO</th>
                            <th>TELÉFONO</th>
                            <th>NOM. REPRE.</th>
                            <th>RUT. REPRE.</th>
<!--                            <th>VER MÁS</th>-->
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
        
        $('#tabla_form_contacto').DataTable({
            scrollX: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "ajax": {
                url: base_url + "tabla_form_contacto",
                type: 'post'
            },
            "iDisplayLength": 5,
            "bJQueryUI": false,
            "dom": 'Bfrtip',
            "columnDefs": [
                {"orderable": false, "targets": 1},
                {"orderable": false, "targets": 2},
                {"orderable": false, "targets": 3},
                {"orderable": false, "targets": 4},
                {"orderable": false, "targets": 5},
                {"orderable": false, "targets": 6},
                {"orderable": false, "targets": 7},
                {"orderable": false, "targets": 8},
                {"orderable": false, "targets": 9}
//                {"orderable": false, "targets": 10},
//                {targets: [10],
//                    "defaultContent": '<button id="boton_acciones" class="btn btn-success" type="submit"><i class="fa fa-edit"></i></button>'
//                }
            ],
            "buttons": [
                {
                    filename: 'Listado de contactos tributarios',
                    extend: 'excelHtml5',
                    download: 'open',
                    title: '',
                    exportOptions: {
                        columns: [2, 3, 4, 5, 6, 7, 8, 9]
                    },
                    customize: function (xlsx) {
                        var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                        source.setAttribute('name', 'Listado SofGem');
                    }
                }
            ],
            "lengthChange": false,
            "order": [[0, "desc"]],
            "info": false
        });

        $("body").on("click", "#boton_acciones", function (excepcion) {
            excepcion.preventDefault();
            var id_form = $(this).parent().parent().children()[0];
            var id_form_contacto = $(id_form).text();

            $.ajax({
                url: base_url + "id_form_contacto",
                type: 'post',
                dataType: 'json',
                data: {id_form_contacto: id_form_contacto},
                success: function (result) {
                    $.each(result, function (i, o) {
                        $("#id_contacto").val(o.id_contacto);
                        $("#razon_social_contacto").val(o.razon_social_contacto);
                        $("#rut_empresa_contacto").val(o.rut_empresa_contacto);
                        $("#direccion_contacto").val(o.direccion_contacto);
                        $("#localidad_contacto").val(o.localidad_contacto);
                        $("#giro_contacto").val(o.giro_contacto);
                        $("#correo_contacto").val(o.correo_contacto);
                        $("#telefono_contacto").val(o.telefono_contacto);
                        $("#nombre_representante_contacto").val(o.nombre_representante_contacto);
                        $("#rut_representante_contacto").val(o.rut_representante_contacto);
                        $("#modal_id_contacto").modal('show');
                    });
                },
                error: function () {
                    alert('Error 500');
                }
            });
        });
    });
</script>