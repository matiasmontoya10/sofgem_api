<?php
$usuario = $this->session->userdata("administrador");
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <title>SofGem | Api</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/fonts/icomoon/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/fonts/flaticon/font/flaticon.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/aos.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/css/resolucion.css">
        <link rel="icon" href="<?php echo base_url(); ?>framework/imagenes/iconos/icon_sofgem.png" sizes="32x32" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>framework/toast/toastr.min.css" />

        <!--Data Table-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap.min.css">
        <!--Data Table-->

        <script src="<?php echo base_url(); ?>framework/js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url(); ?>framework/toast/toastr.min.js"></script>

        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

        <script>
            var base_url = "http://localhost/sofgem_api/";
            var id_usuario_php = <?php echo $usuario[0]->id_usuario ?>;
            var rut_usuario_php = '<?php echo $usuario[0]->rut_usuario ?>';
            var id_perfil_php = <?php echo $usuario[0]->id_perfil ?>;
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
        </script>
    </head>
    <body>
        <div>
            <div class="site-wrap">
                <div class="border-bottom top-bar py-2 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12" style="color: #616161">
                                <p class="mb-0 ocultar-div" style="text-align: center">
                                    <a style="color: #616161"><i class="fa fa-user"></i><strong> <?php echo ' ' . $usuario[0]->nombre_usuario . ' ' . $usuario[0]->apellido_usuario; ?> | </strong></a>
                                    <a href="<?php base_url(); ?>cliente/cerrar_sesion" class="scroll"><span class="btn btn-success btn-sm" style="color: white"><i class="fa fa-ban"></i><b style="color: white"> Salir</b></span></a>                                </p>
                                <p class="mb-0 mostrar-div" style="text-align: center">
                                    <i class="fa fa-user"></i><strong><?php echo ' ' . $usuario[0]->nombre_usuario . ' ' . $usuario[0]->apellido_usuario; ?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <header class="py-4" style="background: #212121">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <img src="<?php echo base_url(); ?>framework/imagenes/iconos/sofgem.png" alt="sofgem" width="165" height="42.5" class="rounded mx-auto d-block">
                            </div>
                        </div>
                    </div>
                </header>
            </div>