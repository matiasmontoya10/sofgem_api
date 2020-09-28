<div class="site-section bg-light">
    <form id="formulario_recuperar_usuario" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <br>
                    <h2 class="text-center"><b style="color: #5cb85c">SofGem |</b><b style="color: #616161"> Recuperar Clave</b></h2>
                    <br>
                    <p style="text-align: justify">Se enviará un mensaje a su correo electrónico registrado en nuestra base de datos para obtener la clave olvidada. En caso de no obtener dicho mensaje se deberá comunicar con el administrador del sitio web.</p>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="rut_usuario">Rut:</label>
                        <input type="text" class="form-control" id="rut_usuario" name="rut_usuario" placeholder="123456789-0" maxlength="20" style="border-color: #78AD39">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="correo_usuario">Correo:</label>
                        <input type="text" class="form-control" id="correo_usuario" name="correo_usuario" placeholder="mmontoya@sofgem.cl" maxlength="50" style="border-color: #78AD39">
                    </div>
                </div>
                <div class="col-md-12 col-lg-12" style="text-align: center">
                    <div class="form-group">
                        <br>
                        <a href="<?php echo base_url(); ?>cliente/index"><span class="btn btn-md"><b style="color: #616161">Salir</b></span></a>
                        <button type="submit" class="btn btn-success btn-md text-white" id="recuperar_usuario">Recuperar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
