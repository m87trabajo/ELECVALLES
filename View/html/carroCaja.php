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
<?php function A_carroCaja() {?>
     <div class="top-cart-title">
        <h4>Lista Productos</h4>
    </div> 
     <div class="wrpCloseCross">
         <span class="fa fa-times closeCross" aria-hidden="true"></span>
    </div>    
        
<?php }?>
<?php function B_carroCaja() {?>
    <div class="top-cart-items">
<?php }?>
<?php function C_carroCaja($product_name, $product_price, $product_code, $product_qty, $product_image) {?>
        <div class="col-xs-12 cartItem">
            <div class="col-xs-3 no-padding">
                <div class="top-cart-item-image">
                    <a href="#">
                        <img src="img_productos/<?php echo $product_image; ?>.jpg" alt="<?php echo $product_name; ?>" />
                    </a>                           
                </div>
            </div>
            
            <div class="col-xs-8 paddinglateral">
                <div class="col-xs-12 no-padding">
                    <a href="#" class="top-cart-item-desc"><?php echo $product_name; ?></a>
                </div>
                <div class="col-xs-12 no-padding">
                    <span class="top-cart-item-price"><?php echo $product_price; ?>&nbsp;€</span>
                </div>                  
            </div>
            
            <div class="col-xs-1 no-padding">
                <div class="col-xs-12 no-padding">
                    <span class="top-cart-item-quantity">x&nbsp;<?php echo $product_qty; ?></span>
                </div>
                <div class="col-xs-12 no-padding">
                    <a data-code="<?php echo $product_code; ?>" class="remove-item" href="#">
                        <span class="fa fa-trash"></span>
                    </a>
                </div>
            </div>
        </div>
<?php }?>

<?php function D_carroCaja($total) {?>
        <div class="top-cart-action clearfix">
            <div class="col-xs-12 no-padding">
                <div class="col-xs-7 no-padding">
                    <div class="col-xs-12 no-padding">
                        <span class="">Total:</span>
                    </div>
                    <div class="col-xs-12 no-padding">
                        <span class="top-checkout-price"><?php echo $total; ?>&nbsp;€</span>
                    </div>
                </div>
                <div class="col-xs-5 no-padding">
                    <button class="btn btn-primary pull-right">Ver resumen</button>
                </div>
            </div>
        </div>   
    <?php }?>
<?php function B_1_carroCaja() {?>        
    </div>
<?php }?>
<?php function Z_carroCaja() {?>
    <div class="col-xs-12 top-cart-items tcenter">
     <p>Carro vacio!</p>         
    </div>
<?php }
