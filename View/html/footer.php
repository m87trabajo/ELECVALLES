<?php
/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:00-00-2016    -VERSION:V.0.0    -LENGUAJE:HTML
  -TITULO:Html/View/footer.php
  -RETRUN: ---
  -VENTAJAS:---
  -RESUMEN:---
  -DATABASE:---
  -FUNCIONAMIENTO:---
  -ERRORES:---
  ---!IMPORTANTE!---:
  ##################################################################################################
  ################################################################################################## */

/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */
?>
<?php

function A_FOOTER() { ?>
<!-- ============================================================= FOOTER : START============================================================= -->
    <footer>
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col_12_RS_SXS col-xs-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="module-heading">
                            <h4 class="module-title">SERVICIOS</h4>
                        </div><!-- /.module-heading -->

                        <div class="separador_small"></div>
                        <div class="module-body">
                            <ul class='list-unstyled'>
                                <li><a href="#">Instalaciones Eléctricas</a></li>
                                <li><a href="#">Automatización y robótica</a></li>
                                <li><a href="#">Instalaciones de climatización</a></li>
                                <li><a href="#">Instalaciones de fontanería</a></li>
                                <li><a href="#">Informática</a></li>
                            </ul>
                        </div><!-- /.module-body -->
                    </div><!-- /.col -->

                    <div class="col_12_RS_SXS col-xs-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="module-heading">
                            <h4 class="module-title">ELECVALLES.COM</h4>
                        </div><!-- /.module-heading -->

                        <div class="separador_small"></div>
                        <div class="module-body">
                            <ul class='list-unstyled'>
                                <li><a href="#">Empresa</a></li>
                                <li><a href="#">Tienda Online</a></li>
                                <li><a href="#">Ofertas</a></li>
                                <li><a href="#">Noticias</a></li>
                            </ul>
                        </div><!-- /.module-body -->
                    </div><!-- /.col -->

                    <div class="clearfix_RS_LG"></div>

                    <div class="col_12_RS_SXS col-xs-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="module-heading">
                            <h4 class="module-title">¿NECESITAS AYUDA?</h4>
                        </div><!-- /.module-heading -->

                        <div class="separador_small"></div>
                        <div class="module-body">
                            <ul class='list-unstyled'>
                                <li><a href="#">Ayuda</a></li>
                                <li><a href="#">Ubicacion</a></li>
                            </ul>
                        </div><!-- /.module-body -->
                    </div><!-- /.col -->

                    <div class="col_12_RS_SXS col-xs-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="module-heading">
                            <h4 class="module-title">CONTACTO</h4>
                        </div><!-- /.module-heading -->

                        <div class="separador_small"></div>
                        <div class="module-body">
                            <ul class='list-unstyled'>
                                <li><span>Calle Can Pantiquet, 82-100.</span></li>
                                <li><span>08100, Mollet del Vallès-BCN</span></li>
                                <li><span><strong>Horario:</strong></span></li>
                                <li><span>Lun-Vie</span></li>
                                <li><span>8:00-18:00</span></li>
                            </ul>
                        </div><!-- /.module-body -->
                    </div>
                </div>
            </div>
        </div>

        <div class="footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <div class="row">
                            <div class="menuFooter col-sm-12">
                                <ul class="no-margin">
                                    <li class="col_12_RS_SXS col-xs-6 col-sm-3 col-md-3 col-lg-3 no-padding"><a href="#">Contacto</a></li>
                                    <li class="col_12_RS_SXS col-xs-6 col-sm-3 col-md-3 col-lg-3 no-padding"><a href="#">Nota legal</a></li>
                                    <li class="col_12_RS_SXS col-xs-6 col-sm-3 col-md-3 col-lg-3 no-padding"><a href="#">Privacidad</a></li>
                                    <li class="col_12_RS_SXS col-xs-6 col-sm-3 col-md-3 col-lg-3 no-padding"><a href="#">Términos y Cond.</a></li>
                                </ul>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="attentionConsumer col-sm-12">
                                <span class="attention">IVA INCLUIDO.</span>
                                <span>Los precios estan sujetos a variación sin previo aviso o error tipográfico.</span>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="copyright col-sm-12">
                                <span>Marc Elcacho.</span>
                                <span>2016</span>
                                <span>-V:1.0</span>
                            </div>  
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-5 no-padding">
                        <div class="clearfix payment-methods pull_right_RS_SM">
                            <ul class="no-margin">
                                <li><img src="View/img/visa.png" alt=""></li>
                                <li><img src="View/img/mastercard.png" alt=""></li>
                                <li><img src="View/img/paypal.png" alt=""></li>
                                <li><img src="View/img/maestro.png" alt=""></li>
                                <li><img src="View/img/dinersClub.png" alt=""></li>
                            </ul>
                        </div><!-- /.payment-methods -->                
                    </div>
                </div>
            </div>
        </div>

    </footer>
<!-- ============================================================= FOOTER : END============================================================= -->

<?php } ?>
