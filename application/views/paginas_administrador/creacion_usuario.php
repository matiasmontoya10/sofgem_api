<?php $usuario = $this->session->userdata("administrador"); ?>
<div class="site-section bg-light">
    <form id="formulario_crear_usuario" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <br>
                    <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Crear Usuario</b></h2>
                    <input type="hidden" id="id_perfil" name="id_perfil" value="<?php echo $usuario[0]->id_perfil; ?>" readonly="true">
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="rut_usuario">Rut:</label>
                        <input type="text" class="form-control" id="rut_usuario" name="rut_usuario" placeholder="19390359-2" maxlength="20" style="border-color: #8bc34a">
                    </div>
                    <div class="form-group">
                        <label for="nombre_usuario">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Ingrese nombre" maxlength="50" style="border-color: #8bc34a">
                    </div>
                    <div class="form-group">
                        <label for="apellido_usuario">Apellido:</label>
                        <input type="text" class="form-control" id="apellido_usuario" name="apellido_usuario" placeholder="Ingrese apellido" maxlength="50" style="border-color: #8bc34a">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="correo_usuario">Correo:</label>
                        <input type="text" class="form-control" id="correo_usuario" name="correo_usuario" placeholder="mmontoya@sofgem.cl" maxlength="50" style="border-color: #8bc34a">
                    </div>
                    <div class="form-group">
                        <label for="telefono_usuario">Teléfono: <b>(Opcional)</b></label>
                        <input type="text" class="form-control validar_numero" id="telefono_usuario" name="telefono_usuario" placeholder="983006194" maxlength="9" style="border-color: #8bc34a">
                    </div>
                    <div class="form-group">
                        <label for="estado_usuario">Estado Usuario:</label>
                        <select class="form-control" id="estado_usuario" name="estado_usuario" style="border-color: #8bc34a">
                            <option value="1">Super Administrador</option>
                            <option value="3">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12" style="text-align: center">
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-success btn-md text-white" id="crear_usuario">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $('.validar_numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
