<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-12 text-center">
                <br>
                <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Suscribete</b></h2>
                <br>
                <table id="tabla_contacto" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>N° ID</th>
                            <th>NOMBRE</th>
                            <th>TELÉFONO</th>
                            <th>FECHA ENVÍO</th>
                            <th>ELIMINAR</th>
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
        $('#tabla_contacto').DataTable({
            scrollX: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "ajax": {
                url: base_url + "tabla_contacto",
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
                {targets: [4],
                    "defaultContent": '<button id="boton_eliminar_contacto" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>'
                }
            ],
            "buttons": [
                {
                    title: 'TUE | Suscribete',
                    messageTop: 'Suscripciones.',
                    filename: 'Suscribete',
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
                        columns: [0, 1, 2]
                    }
                }
            ],
            "lengthChange": false,
            "order": [[0, "desc"]],
            "info": false
        });

        $("body").on("click", "#boton_eliminar_contacto", function (excepcion) {
            excepcion.preventDefault();
            var estado = "";
            var id_perfil = id_perfil_php;
            var id_contacto_table = $(this).parent().parent().children()[0];
            var id_contacto = $(id_contacto_table).text();

            if (id_perfil == 1) {
                $.ajax({
                    url: base_url + 'eliminar_contacto',
                    type: 'post',
                    dataType: 'json',
                    data: {id_contacto: id_contacto},
                    success: function (resultado) {
                        estado = "info";
                        validar_vista(estado, resultado.mensaje);
                        $("#tabla_contacto").DataTable().ajax.reload();
                    },
                    error: function () {
                        alert("Error 500");
                    }
                });
            } else {
                estado = "warning";
                validar_vista(estado, "Permisos insufientes para eliminar");
            }
        });
    });
</script>
