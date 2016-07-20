<?php

/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:00-00-2016    -VERSION:V.0.0    -LENGUAJE:JAVASCRIPT
  -TITULO:---
  -RETRUN: ---
  -VENTAJAS:---
  -RESUMEN:---
  -DATABASE:---
  -FUNCIONAMIENTO:---
  -ERRORES:---
  ---!IMPORTANTE!---:
  /*--------------------------------------------SEGURIDAD--------------------------------------------
  No hace falta comprobacion de $_POST["codigo_producto"] pq array_search() se encarga de buscarla en $_SESSION['shop']['indexValidNumProducts']
  si esta la coje de $_SESSION['shop']['indexValidNumProducts'].
  La peticion a servidor se hace con un codigo_producto VALIDO.

  ##################################################################################################
  ################################################################################################## */
/* ======================================= 
  SESSION
  ======================================== */


/* ======================================= 
  INCLUDES
  ======================================== */
require_once 'funcSessionStarted.php'; //Puede ser llamada por php y ja tendria session_start() pero si es llamada por mainIndex.js AJAX necesita iniciar session
require_once 'funcAutoLoad.php';
require_once $_SESSION['shop']['publicPath'] . '/View/html/carroCaja.php';

/* ======================================= 
  OBJETO
  ======================================== */

/* ======================================= 
  VARIABLES
  ======================================== */


/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */
switch ($_POST["opt"]) {
    case 1:// COUNT ELEMENTS CARRO PRIMERA VEZ
        countElementsFirstLoop();
        break;

    case 2://ADD ITEMS IN CART
        if (isset($_POST["codigo_producto"]) && isset($_POST["qtyProducto"])) {
            /* VARIABLES FILTERED */
            $qtyProducto = intval(filter_var($_POST["qtyProducto"], FILTER_SANITIZE_NUMBER_INT));
            if ($qtyProducto < 0) {
                $qtyProducto = 1;
            }
            addItemsInCart($_POST["codigo_producto"], $qtyProducto);
        }
        break;

    case 3://SHOW ITEMS IN CART
        showItemsInCart();
        break;

    case 4://REMOVE ITEMS FROM CART
        if (isset($_POST["remove_code"])) {
            removeItemsFromCart();
        }
        break;
    default:
        echo "ERROR-Controller/genCarroCaja.php";
}


/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */
/* ======================================= 
  COUNT ELEMENTS CARRO PRIMERA VEZ
  ======================================== */

function countElementsFirstLoop() {
    $aTotals = array();
    $total_ItemsAndQty = countItemsAndQtyInCart();
    $total_items = countItemsInCart();
    array_push($aTotals, $total_ItemsAndQty, $total_items);

    die(json_encode($aTotals, JSON_UNESCAPED_UNICODE)); //exit and output content    
}

/* ======================================= 
  ADD ITEMS IN CART
  ======================================== */

function addItemsInCart($codigo_producto, $iQtyProducto) {

    $flagExists = false; //var si no existe articulo devuelve a json false para no añadir nada al carro.
    $clave = array_search($codigo_producto, $_SESSION['shop']['indexValidNumProducts'], true);

    if (is_int($clave)) {
        $codProducto = $_SESSION['shop']['indexValidNumProducts'][$clave];

        /* OBJETO */
        $shop = new Shop('aux');
        $shop->CarroCajaAjaxRequestProductByCodProducto($codProducto); //SELECT nombre_producto,pvp,imagen FROM productos WHERE codigo_producto = :num_producto LIMIT 1
        $aProduct = $shop->getArrAux(); 
        //var_dump($aProduct);///----DEBUG---


        foreach ($aProduct[0] as $clave => $valor) {
            $new_product[$clave] = $valor;
        }
        $new_product["product_qty"] = $iQtyProducto;  //
        
//      $new_product["nombre_producto"]= $aProduct[0]["nombre_producto"]; //fetch product name from database///----HELP---
//      $new_product["pvp"] = $aProduct[0]["pvp"];  //fetch product price from database///----HELP---
//      $new_product["product_qty"] = $iQtyProducto;  /////----HELP---
//      $new_product["imagen"] = $aProduct[0]["imagen"];///----HELP---

        if (isset($_SESSION['shop']['carroProductos'][$codProducto])) { //check item exist in products array
            $cant = intval($_SESSION['shop']['carroProductos'][$codProducto]["product_qty"]);
            //echo "cantidad".$cant;
            $new_product["product_qty"] = $cant + 1;
            unset($_SESSION['shop']['carroProductos'][$codProducto]); //unset old item
        }


        $_SESSION['shop']['carroProductos'][$codProducto] = $new_product;    //update products with new item array   
        //RETURN A JSON View/js//headerCartProcces.js
        $flagExists = true;
    }
    //var_dump($_SESSION['shop']['carroProductos']);///----DEBUG---
    die(json_encode($flagExists, JSON_UNESCAPED_UNICODE)); //Necesita return por funcion de in_array() pk sino devuelve null
}

/* ======================================= 
  SHOW ITEMS IN CART
  ======================================== */

function showItemsInCart() {
    A_carroCaja();

//    var_dump($_SESSION['shop']['carroProductos']);///----DEBUG---
//    echo count($_SESSION['shop']['carroProductos']);///----DEBUG---
//    exit();///----DEBUG---

    if (is_null($_SESSION['shop']['carroProductos']) || count($_SESSION['shop']['carroProductos']) === 0) {
        Z_carroCaja();
    } elseif (count($_SESSION['shop']['carroProductos']) > 0) {
        $total = 0;

        B_carroCaja(); ///HTML <div class="col-xs-12 cartItem">

        foreach ($_SESSION['shop']['carroProductos'] as $clave => $item) { //loop though items and prepare html content
            $product_name = $item["nombre_producto"];
            $product_price = $item["pvp"];
            $product_code = $clave;
            $product_qty = $item["product_qty"];
            $product_image = $item["imagen"];

            C_carroCaja($product_name, $product_price, $product_code, $product_qty, $product_image);

            $subtotal = ($product_price * $product_qty);
            $total = ($total + $subtotal);
        }

        B_1_carroCaja(); ///HTML </div> class="col-xs-12 cartItem">

        D_carroCaja($total);
    } elseif (count($_SESSION['shop']['carroProductos']) > 1 && $_POST['firstElement'] === false) {
        
    }

    die();
}

/* ======================================= 
  REMOVE ITEMS FROM CART
  ======================================== */

function removeItemsFromCart() {
    $product_code = filter_var($_POST["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

    if (isset($_SESSION['shop']['carroProductos'][$product_code])) {
        unset($_SESSION['shop']['carroProductos'][$product_code]);
    }

    die(); //No necesita return pk escribe en $_SESSION['shop']['carroProductos']   
}

/* ======================================= 
  COUNT ITEMS AND QTY IN CART
  ======================================== */

function countItemsAndQtyInCart() {
    $total_items = 0;
    if (!is_null($_SESSION['shop']['carroProductos']) && count($_SESSION['shop']['carroProductos']) > 0) {
        foreach ($_SESSION['shop']['carroProductos'] as $key) {
            $total_items = $total_items + $key["product_qty"];
        }
    }
    return $total_items;
}

/* ======================================= 
  COUNT ITEMS IN CART
  ======================================== */

function countItemsInCart() {
    $total_items = 0;
    if (!is_null($_SESSION['shop']['carroProductos']) && count($_SESSION['shop']['carroProductos']) > 0) {
        $total_items = count($_SESSION['shop']['carroProductos']);
    }
    return $total_items;
}

/*  =================================================================================== 
 ---AJAX CLICK EN TAB DE GRUPOS TABS SLIDER---Controller/AJAXNavTabSlider.php
 ======================================================================================                       */
