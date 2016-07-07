<?php

function A_TBS($sGroupName) { ;?>
                <section>
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
<?php } ;?>

 <?php

function B_TBS($first_loop, $no_spaces, $nameGrupo) { ;?>

    <li <?php echo $first_loop ;?>>
        <a data-transition-type="backSlide" href="#<?php echo $no_spaces ;?>" data-toggle="tab"><?php echo $nameGrupo ;?></a>
    </li>
<?php } ;?>

<?php

function C_TBS() { ;?>
                                                </ul><!-- /.nav-tabs -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php } ;?>

<?php

function D_TBS() { ;?>     
                            <div class="tab-content WrapperProducts_TBS outer_top_xs">  

<?php } ;?>
                                
<?php                                         
function E_TBS($no_spaces) { ;?>     
                                <div id="<?php echo $no_spaces ;?>" class="tab-pane active">  
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">

<?php } ;?>

<?php

function E_1_TBS($string_vNO, $data_valor_oferta, $codigo_producto, $nombre_producto, $pvp, $pvp_incrementado, $imagen, $sHotNewSale) { ;?>
                                            <div class="item item-carousel">
                                                <div class="products">

                                                    <div class="product">
                                                        <div class="product_image">
                                                            <div class="image">
                                                                <a href="detail.php?<?php echo $string_vNO . 'cod=' . $codigo_producto ;?>"><img  src="img_productos/<?php echo $imagen . '.jpg' ;?>" alt="<?php echo $nombre_producto ;?>"></a>
                                                            </div><!-- /.image -->

                                                            <div class="tag <?php echo $sHotNewSale ?>"><span><?php echo $sHotNewSale ?></span></div>
                                                        </div><!-- /.product_image -->


                                                        <div class="product_info text-left">
                                                            <h3 class="name">
                                                                <a href="detail.php?<?php echo $string_vNO . 'cod=' . $codigo_producto ;?>"><?php echo $nombre_producto ;?></a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="id_product">
                                                                <span class="value"><?php echo $codigo_producto ;?></span>
                                                            </div>  

                                                            <div class="product_price">
                                                                <span class="price"><?php echo $pvp ;?></span>
                                                                <span class="price_before_discount"><?php echo $pvp_incrementado ;?></span>
                                                            </div><!-- /.product_price -->

                                                        </div><!-- /.product_info -->
                                                        <div class="cart clearfix">

                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add_cart_button btn-group">
                                                                        <button type="button" data-toggle="dropdown" class="btn btn-primary icon">
                                                                            <i class="fa fa-shopping-cart"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-primary add_button" data_valor_oferta ="<?php echo $data_valor_oferta ;?>" data-value="<?php echo $codigo_producto ;?>">Añadir al carrito</button>

                                                                    </li>

                                                                    <li class="lnk wishlist">
                                                                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                                            <i class="fa fa-heart"></i>
                                                                        </a>
                                                                    </li>

                                                                    <li class="lnk">
                                                                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                                            <i class="fa fa-retweet"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div><!-- /.action -->
                                                        </div><!-- /.cart -->
                                                    </div><!-- /.product -->

                                                </div><!-- /.products -->
                                            </div><!-- /.item -->
<?php } ;?>

<?php

function E_2_TBS() { ;?>
                                        </div><!-- /.home-owl-carousel --> 
                                    </div><!-- /.product-slider -->
                                </div><!-- /.tab-pane -->
<?php } ;?>

<?php

function F_TBS() { ;?>

                            </div><!-- /.tab-content -->
<?php } ;?>
                            
<?php

function G_TBS() { ;?>                            
                        </div><!-- /.scroll_tabs -->
                    </div><!-- /.homebanner-holder -->
                </section>
<?php } ;?>

