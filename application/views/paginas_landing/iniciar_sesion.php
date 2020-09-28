<div class="site-blocks-cover overlay" style="background-image: url(<?php echo base_url(); ?>framework/imagenes/notebook.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                <div class="row justify-content-center mb-4">
                    <div class="col-md-12 text-center">
                        <h1 class="text-center"><b style="color: greenyellow">SofGem</b> | Login</h1>                                    
                        <br>
                        <form class="p-1">
                            <div class="row form-group">
                                <div class="col-md-6 offset-md-3">
                                    <label class="text-white" for="rut_usuario"><median style="color: white">Rut:</median></label>
                                    <input type="text" id="rut_usuario" class="form-control" style="border-color: #616161" maxlength="20" placeholder="13688758-0">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6 offset-md-3">
                                    <label class="text-white" for="clave_usuario"><median style="color: white">Contraseña:</median></label> 
                                    <input type="password" id="clave_usuario" class="form-control" style="border-color: #616161" maxlength="20" placeholder="******">
                                </div>
                            </div>
                            <br>
                            <a href="<?php echo base_url(); ?>cliente/recuperar"><b style="color: white">¿Olvidaste tu contraseña?</b></a>
                            <div class="row form-group" style="text-align: center">
                                <div class="col-md-6 offset-md-3">
                                    <br>                                                
                                    <a href="https://sofgem.cl/"><span class="btn btn-lg"><b style="color: white">Ir a sofgem.cl</b></span></a>
                                    <button type="submit" class="btn btn-lg btn-success" id="boton_iniciar_sesion" style="color: white"><b>Entrar</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>