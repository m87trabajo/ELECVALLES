<?php
/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:00-00-2016    -VERSION:V.0.0    -LENGUAJE:HTML
  -TITULO:Html/View/tabSlider.php
  -RETRUN: ---
  -VENTAJAS:---
  -RESUMEN:Genera HTML tabSlider
  -DATABASE:---
  -FUNCIONAMIENTO:---
  -ERRORES:---
  ---!IMPORTANTE!---:
  ##################################################################################################
  =======================================
  -----------!!!!ATENCION¡¡¡¡------------
  ========================================
  NO FORMATEAR ALT+MAYS+F
  BORRAR TODOS LOS CRLF I ESPACIOS EN BLANCO ENTRE FUNCIONES PHP
  ESPACIOS I SALTOS DE LINIA CRLF GENEREAN UN MAL HTML
  ################################################################################################## */
/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */
?>
<?php function A_TBS($sGroupName) {?>
                <section class="wrpTabSlider">
                    <div class = "col-lg-12 homebanner-holder">
                        <!--============================================= = SCROLL TABS ============================================= = -->
                        <div class = "scroll_tabs product-tabs-slider wow fadeInUp">
                            <div class = "more_info_tab clearfix ">
                                <div class = "row">
                                    <div class = "col-lg-12">
                                        <div class = "row">
                                            <div class = "col-xs-12 col-sm-4 col-md-4 ">
                                                <h3 class = "new_product_title pull-left"><?php echo $sGroupName ?></h3>
                                            </div>
                                            <div class = "col-xs-12 col-sm-8 col-md-8">
                                                <ul class = "new-products nav nav-tabs nav_tab_line">   
<?php }?>
<?php function B_TBS($first_loop, $no_spaces, $nameGrupo) {?>
                                                    <li <?php echo $first_loop ;?>>
                                                        <a data-transition-type="backSlide" href="#<?php echo $no_spaces ;?>" data-toggle="tab"><?php echo $nameGrupo ;?></a>
                                                    </li>
<?php }?>
<?php function C_TBS() {?>
                                                </ul><!-- /.nav-tabs -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php }?>
<?php function D_TBS() {?>
                            <div class="tab-content WrapperProducts_TBS outer_top_xs">
<?php }?>
<?php function E_TBS($no_spaces) {?>
                                <div id="<?php echo $no_spaces ;?>" class="tab-pane active">  
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
<?php }?>
<?php function E_1_TBS($string_vNO, $data_valor_oferta, $codigo_producto, $nombre_producto, $pvp, $pvp_incrementado, $imagen, $sHotNewSale) {?>
                                            <div class="item item-carousel">
                                                <div class="products">

                                                    <div class="product">
                                                        <div class="product_image">
                                                            <div class="image">
                                                                <a href="detail.php?<?php echo $string_vNO . 'cod=' . $codigo_producto;?>"><img  src="img_productos/<?php echo $imagen . '.jpg' ;?>" alt="<?php echo $nombre_producto ;?>"></a>
                                                            </div><!-- /.image -->

                                                            <div class="tag <?php echo $sHotNewSale ?>"><span><?php echo $sHotNewSale ?></span></div>
                                                        </div><!-- /.product_image -->


                                                        <div class="product_info text-left">
                                                            <h3 class="name">
                                                                <a href="detail.php?<?php echo $string_vNO . 'cod=' . $codigo_producto ;?>"><?php echo $nombre_producto;?></a>
                                                            </h3>
<!--                                                            <div class="rating rateit-small"></div>-->
                                                            <div class="id_product hide">
                                                                <span class="value"><?php echo $codigo_producto ;?></span>
                                                            </div>  

                                                            <div class="product_price">
                                                                <span class="price"><?php echo $pvp ;?>&nbsp;€</span>
                                                                <span class="price_before_discount"><?php echo $pvp_incrementado ;?>&nbsp;€</span>
                                                            </div><!-- /.product_price -->

                                                        </div><!-- /.product_info -->
                                                        <div class="cart clearfix">

                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add_cart_button btn-group">
                                                                        <button type="button" data-toggle="dropdown" class="btn btn-primary icon">
                                                                            <span class="fa fa-shopping-cart"></span>
                                                                        </button>
                                                                        <button type="button" class="btn btn-primary add_button" data-valor-oferta ="<?php echo $data_valor_oferta ;?>" data-value="<?php echo $codigo_producto ;?>">Añadir al carrito</button>

                                                                    </li>

                                                                    <li class="lnk wishlist">
                                                                        <button type="button" class="btn btn-primary">
                                                                            <span class="fa fa-heart"></span>
                                                                        </button>
                                                                    </li>

                                                                    <li class="lnk compare">
                                                                        <button type="button" class="btn btn-primary">
                                                                            <span class="fa fa-retweet"></span>
                                                                        </button>

                                                                    </li>
                                                                </ul>
                                                            </div><!-- /.action -->
                                                        </div><!-- /.cart -->
                                                    </div><!-- /.product -->

                                                </div><!-- /.products -->
                                            </div><!-- /.item -->
<?php }?>
<?php function E_2_TBS() {?>
                                        </div><!-- /.home-owl-carousel --> 
                                    </div><!-- /.product-slider -->
                                </div><!-- /.tab-pane -->
<?php }?>
<?php function F_TBS() {?>
                            </div><!-- /.tab-content -->
<?php }?>
<?php function G_TBS() {?>
                        </div><!-- /.scroll_tabs -->
                    </div><!-- /.homebanner-holder -->
                </section>
<?php }