<?php

/* ##################################################################################################
  ###################################################################################################
  AUTOR:ELCACHO GRNADOS,MARC
  FEHCA:26-06-2016
  VERSION:V.0.1
  FUNCIONAMIENTO:
  Lee grupos de tabla a_grupo_cantidad. Lee productos de tabla f_random_products.
  Segun cantidad de tabla a_grupo_cantidad va desde el primer grupo hasta $numero_filas.
  Para cada grupo que exista imprime func b() hasta func d().
  Imprimie para cada grupo todos los productos que existan en f_random_products.
  ##################################################################################################
  ################################################################################################## */


require_once 'funcAutoLoad.php';
require_once 'View/html/productsTabsSlider.php';

/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */
/* ======================================= 
  AJUSTAR SEGUN PREFERENCIA
  ======================================== */

$numero_filas = 4; //EN MODO COLUMNA HACIA DERECHA

/* ======================================= 
  OBJETO
  ======================================== */
$shop = new Shop('aux');
$shop->TabsSliderGroups(); //'SELECT grupo FROM a_grupo_cantidad;'
$aGrupos = $shop->getArrAux(); //Contenedor de SELECT grupo FROM a_grupo_cantidad.

$GLOBALS['aProducts'] = array();
$shop->TabsSliderProducts(); //'SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products;';
$GLOBALS['aProducts'] = $shop->getArrAux();

/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES HTML */
$html = ''; //Contenedor Html.
$no_spaces = ''; //String sin espacios
$first_loop = ''; //Pone classe .active nav nav-tabs nav_tab_line
$count = 0; //count #product-tabs-slider

/* VARIABLES FUNCION */
$num_rows = count($aGrupos); //Count rows.
$resto = $num_rows; //Cantidad de elementos por poner
$inicio = $num_rows - $num_rows; //Empieza a colocar elementos desde elemento
$actual = 0; //Valor hasta donde a colocado elementos
$cnt = 0; //Contador hasta $numero_filas.


/* ======================================= 
  ALGORITMO
  ======================================== */
a(); //HTML productsTabsSlider.php

while ($resto > 0) {
    if ($resto > $numero_filas) {
        $actual = $inicio + $numero_filas;
    } else {
        $actual = $resto + $inicio;
    }
    b($count); //HTML productsTabsSlider.php
    $count++;
    for ($i = $inicio; $i < $actual; $i++) {
        if ($i == $inicio) {
            $first_loop = 'class="active"';
        } else {
            $first_loop = '';
        }
        $no_spaces = str_replace(' ', '_', $aGrupos[$i]['grupo']);
        c($first_loop, $no_spaces, $aGrupos[$i]['grupo']); //HTML productsTabsSlider.php
    }
    d(); //HTML productsTabsSlider.php
    
    
    for ($i = $inicio; $i < $actual; $i++) {
        if ($i == $inicio) {//MUESTA SOLO LAS PRIMERAS CATEGORIAS
            $first_loop = ' active';
            $no_spaces = str_replace(' ', '_', $aGrupos[$i]['grupo']);
            //-----LEVEL 2--INSIDE----//
            e($first_loop, $no_spaces); //HTML productsTabsSlider.php   
            product_tabs_slider_lvl_2($aGrupos[$i]['grupo']);
            e2();
        }

    }
    f(); //HTML productsTabsSlider.php
    $resto = $resto - $numero_filas;
    $inicio = $inicio + $numero_filas;

    // break;

}
g(); //HTML productsTabsSlider.php



/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */
function product_tabs_slider_lvl_2($grupo) {
//    // $sql='SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products;';
    // var_dump($GLOBALS['aProducts']);
    $string_vNO = "vNO=N&";
    $data_valor_oferta = "N";
    $cnt = 0;
    $exit = false; //SI CAMBIA EL GRUPO Y YA HAVIA PUESTO SALE

    foreach ($GLOBALS['aProducts'] as $clave => $valor) {
        if ($grupo == $GLOBALS['aProducts'][$clave]['grupo']) {
            if ($GLOBALS['aProducts'][$clave]["valor_oferta"] == 1) {
                $string_vNO = "vNO=O&";
                $data_valor_oferta = "O";
            }
            e1($string_vNO, $data_valor_oferta, $GLOBALS['aProducts'][$clave]['codigo_producto'], $GLOBALS['aProducts'][$clave]['nombre_producto'], $GLOBALS['aProducts'][$clave]['pvp'], $GLOBALS['aProducts'][$clave]['pvp_incrementado'], $GLOBALS['aProducts'][$clave]['imagen'], $GLOBALS['aProducts'][$clave]['valor_oferta']);
            $exit = true;
            unset($GLOBALS['aProducts'][$clave]);
        } else if ($exit)
            break;
    }
}
