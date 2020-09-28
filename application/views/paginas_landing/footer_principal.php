<footer class="site-footer" style="background: #212121">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4" style="text-align: center">
                        <h2 class="footer-heading mb-4">Nosotros</h2>
                        <p class="center">+ 56 7 1268 4183 | + 56 9 3950 9055
                            <br>
                            contacto@sofgem.cl 
                            <br> 
                            ventas@sofgem.cl
                        </p>
                    </div>
                    <div class="col-md-4" style="text-align: center">
                        <h2 class="footer-heading mb-4">Síguenos</h2>
                        <h2>
                            <a href="https://www.instagram.com/sofgem_chile/?hl=es-la" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                            <a href="https://www.facebook.com/Sofgem/?modal=admin_todo_tour" class="pl-3 pr-3"><span class="icon-facebook"></span></a>
                            <a href="https://twitter.com/sofgem?lang=es" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                        </h2>
                        <br>
                    </div>
                    <div class="col-md-4">
                        <h2 class="footer-heading mb-4" style="text-align: center">Encuéntranos</h2>
                        <p style="text-align: center">
                            10 oriente #1041 Talca, Chile
                            <br>
                            Lunes a Viernes: 09:00 AM a 19:00 PM
                            <br>
                            Sábado: 09:00 AM a 14:00 PM
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <div class="border-top pt-5">
                    <p>
                        <b>
                            © TUE 2020 &
                            <a href="https://sofgem.cl/" style="color: white">SofGem</a>
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<script src="<?php echo base_url(); ?>framework/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>framework/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/jquery.stellar.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/jquery.countdown.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/aos.js"></script>
<script src="<?php echo base_url(); ?>framework/js/typed.js"></script>
<script src="<?php echo base_url(); ?>framework/toast/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>framework/js/custom.js"></script>
<script src="<?php echo base_url(); ?>framework/js/main.js"></script>

<script>
    $('.validar_numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
<script>
    (function () {
        var options = {
            whatsapp: "+56(9)39509055",
            call_to_action: "¡Escríbenos!",
            position: "right"
        };
        var proto = document.location.protocol,
                host = "getbutton.io",
                url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
</script>
</body>
</html>