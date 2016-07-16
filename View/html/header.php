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

<?php function A() { ?>
<header>
<?php } ?>

<?php function TopHeader() {?>
        <!--TOP HEADER-->
        <div id="top_header">
            <div class="container">
                <div class="row">

                    <div class="col-lg-7"><!--MENSAJE TOP HEADER-->
                        <div class="row visible-lg">
                            <div class="col-md-12">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisic</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5"><!--ENLACES TOP HEADER-->
                        <div class="row">
                            <ul class="lista_top_header">

                                <li class="col-xs-3"><!--ENLACE 1-->
                                    <a href="#">
                                        <ul >
                                            <li class="col-xs-12 visible-xs">
                                                <span class="icon_top_links fa fa-university"></span>
                                            </li>
                                            <li class="col-xs-12 visible-xs hidden_sxs">
                                                <span class="top_links">Empresa</span>
                                            </li>

                                            <li class="hidden-xs col-sm-12"><!--VISIBLE SOLO LARGE-->
                                                <span class="icon_top_links fa fa-university"></span>
                                                <span class="top_links">Empresa</span>
                                            </li>
                                        </ul>
                                    </a>
                                </li>
                                <li class="col-xs-3"><!--ENLACE 2-->
                                    <a href="#">
                                        <ul >
                                            <li class="col-xs-12 visible-xs">
                                                <span class="icon_top_links fa fa-map-marker"></span>
                                            </li>
                                            <li class="col-xs-12 visible-xs hidden_sxs">
                                                <span class="top_links">Ubicación</span>
                                            </li>
                                            <li class="hidden-xs col-sm-12"><!--VISIBLE SOLO LARGE-->
                                                <span class="icon_top_links fa fa-map-marker"></span>
                                                <span class="top_links">Ubicación</span>
                                            </li>
                                        </ul>
                                    </a>
                                </li>
                                <li class="col-xs-3"><!--ENLACE 3-->
                                    <a href="#">
                                        <ul >
                                            <li class="col-xs-12 visible-xs">
                                                <span class="icon_top_links fa fa-question"></span>
                                            </li>
                                            <li class="col-xs-12 visible-xs hidden_sxs">
                                                <span class="top_links">Ayuda</span>
                                            </li>
                                            <li class="hidden-xs col-sm-12"><!--VISIBLE SOLO LARGE-->
                                                <span class="icon_top_links fa fa-question"></span>
                                                <span class="top_links">Ayuda</span>
                                            </li>
                                        </ul>
                                    </a>
                                </li>
                                <li class="col-xs-3"><!--ENLACE 4-->
                                    <a href="#">
                                        <ul >
                                            <li class="col-xs-12 visible-xs">
                                                <span class="icon_top_links fa fa-phone"></span>
                                            </li>
                                            <li class="col-xs-12 visible-xs hidden_sxs">
                                                <span class="top_links">Contacto</span>
                                            </li>
                                            <li class="hidden-xs col-sm-12"><!--VISIBLE SOLO LARGE-->
                                                <span class="icon_top_links fa fa-phone"></span>
                                                <span class="top_links">Contacto</span>
                                            </li>
                                        </ul>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php }?>

<?php   function MainHeader() {?>
        <!--MAIN HEADER-->
        <div id="main_header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7 col-md-6 margen_RS_XS"><!--LOGO-->
                        <div id="main_header_logo">
                            <a href="index.php">
                                <img class="logo" src="View/img/logo.svg" alt="logo empresa">
                                <img class="letras" src="View/img/letras.svg" alt="letras logo empresa">

                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-5 col-md-6"><!--MINI MENU-->
                        <ul id="mini_menu">
                            <li class="col-xs-5 col-md-8"><!--ENLACE 1 MINI MENU-->
                                <a href="#">MI CUENTA</a>
                            </li>

                            <li class="col-xs-7 col-md-4 dropdown"><!--ENLACE 2 MINI MENU-->
                                <a id="carro_enlace" class="dropdown-toggle " data-delay="2500" data-toggle="dropdown" data-hover="dropdown" href="#" aria-expanded="true">CARRITO
                                    <div id="carro_contador" class="basket_item_count hidden_sxs">
                                        <span class="count">

                                            <!--if(isset($_SESSION["productos"])){
                                                $total_items=0;
                                                foreach ($_SESSION["productos"] as $key) {
                                                   $total_items= $total_items+$key["product_qty"];       
                                                }
                                                echo $total_items;
                                            }else{
                                                echo 0; 
                                            }-->

                                        </span>
                                    </div>
                                    <img class="carrito_img hidden_sxs" src="View/img/Carro-vacio.svg" alt="Carro-vacio">
                                </a>
                                <div id="carro_caja" class="dropdown-menu dropdown-menu-right dropdown_cart_menu" >
                                    <div id="carro_resultados">

                                    </div>
                                    <!--<p class="dropdown-cart-description">Recently added item(s).</p>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<?php }?>   

<?php   function FH_1() {?>
        <!--FOOTER HEADER-->
        <div id="footer_header">
            <nav id="navegador" class="navbar navbar-default animacion_dropdown">
                <div class="container">

                    <div class="navbar-header"><!--HEADER RESPONSIVE-->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
                            <span class="sr-only">Menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="#" class="navbar-brand visible-xs">menu</a>
                    </div>
<?php }?>

<?php function FH_2() {?>
                    <div id="menu" class="collapse navbar-collapse"><!--MENU-->
                        <div class="row">                                                       
<?php }?>

<?php function FH_3() {?>
                            <div class="sin_padding_RS_LG col-xs-12 col-sm-12 col-md-12 col-lg-6"><!--PARTE IZQUIERDA MENU DROPDOWNS-->
                                <ul class="nav navbar-nav">                                                         
<?php }?>                                    
                                    
                                    
<?php function FH_4_1($varCSS,$ItemsNameMenu,$width) { ?>
                                    <li class="<?php echo $varCSS;?> dropdown"><!--MENU LVL-1-->

                                        <a class="dropdown-toggle hvr-underline-from-left " data-toggle="dropdown" data-hover="dropdown" href="#"><?php echo $ItemsNameMenu ;?><span class="fa fa-chevron-down hvr-icon-down "></span>
                                        </a>
                                        <ul class="dropdown-menu container <?php echo $width;?>"><!--MENU LVL-2-->
                                            <li>
                                                <div class="padding_dropdown_RS_XS">
                                                    <div class="row">                                       

<?php }?> 
                                    
<?php function FH_4_2($sCSS) { ?>
                                     
                                                        <div class="<?php echo $sCSS;?>">
                                                            <ul class="links">    
<?php }?> 
                                                                
<?php function FH_4_3($NameGroup,$QuantElemGroups,$Href,$NoSpaces) { ?>
                                                                <li>
                                                                    <a href="<?php echo $Href . $NoSpaces ; ?>&level=0">
                                                                        <span class="fa fa-angle-right hvr-icon-forward"></span><?php echo $NameGroup ?>
                                                                    </a>
                                                                    <span>(<?php echo $QuantElemGroups ?>)</span>
                                                                </li>
<?php }?>  
    
<?php function FH_4_4() { ?>
                                                            </ul>
                                                        </div>
                                                      
<?php }?>    
                                                        
<?php function FH_4_5() { ?>
                                                    </div><!--END ROW-->
                                                </div>
                                            </li>
                                        </ul>
                                    </li>            
<?php }?>      
                                                        
                                                            
 <?php function FH_5($Item_3,$Item_4) { ?> 
 

                                    <li><!--MENU LVL-1-->
                                        <a class="link_izq_menu hvr-underline-from-left" href="#"><?php echo $Item_3 ?></a>
                                    </li>
                                    <li><!--MENU LVL-1-->
                                        <a class="link_izq_menu hvr-underline-from-left" href="#"><?php echo $Item_4 ?></a>
                                    </li>
                                </ul>
                            </div>
     
<?php } ?>  
 
  <?php function FH_6() { ?> 
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6"><!--PARTE DERECHA MENU FORM BUSQUEDA-->
                                <div class="row">
                                    <form id="search" class="navbar-form navbar_right_RS_LG" role="search"><!--PARTE DERECHA MENU FORM -->
                                        <div class="input-group-btn">
                                            <div class="sin_padding_RS_LG col-xs-12 col-sm-5 col-md-5 col-lg-5"><!--INPUT BUSCAR-->
                                                <input type="text" class="form-control col_ancho_total sin_padding_RS_LG" placeholder="Buscar"  name="inp_buscar" id="inp_buscar">
                                            </div>
                                            <div class="sin_padding_RS_LG col-xs-12 col-sm-3 col-md-3 col-lg-3"><!--BOTON SELECT 1-->
                                                <button id="select_1" class="btn btn-default dropdown-toggle col_ancho_total" type="button"  data-toggle="dropdown" >Opcion 1&nbsp;<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu bootstrap-select" role="menu" aria-labelledby="select_1">
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">ID</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Preu</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Nom</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Familia</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">SubFamilia</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Nombre</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Modelo</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Oferta</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Descripcion</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>
                                            <div class="sin_padding_RS_LG col-xs-12 col-sm-3 col-md-3 col-lg-3"><!--BOTON SELECT 2-->

                                                <button id="select_2"  class="btn btn-default dropdown-toggle col_ancho_total " type="button" data-toggle="dropdown" >Opcion 2&nbsp;<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu bootstrap-select " role="menu" aria-labelledby="select_2">
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Ascendente</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Descendente</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" href="#" data-tokens="null">
                                                            <span class="text">Nom</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>
                                            <div class="sin_padding_RS_LG col-xs-12 col-sm-1 col-md-1 col-lg-1"><!--BOTON BUSCAR-->
                                                <button id="btn_buscar" class="btn btn-success btn-block col_ancho_total " type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>     
<?php } ?>                             
                            
 <?php function FH_7() { ?> 
                        </div>
                    </div>
                </div>
            </nav><!--END NAV-->
        </div><!--END FOOTER HEADER-->         
<?php } ?>          
        
        

<?php function A_1() { ?>
 </header>
<?php }?>