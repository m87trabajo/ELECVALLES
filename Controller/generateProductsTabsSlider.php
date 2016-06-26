<?php

require_once 'funcAutoLoad.php';
require_once 'View/html/productsTabsSlider.php';


/* AJUSTAR SEGUN PREFERENCIA */
$numero_filas = 4; //EN MODO COLUMNA HACIA DERECHA

/* OBJETO */
$shop = new Shop('aux');
$shop->TabsSliderGroups();
$aGrupos = array(); //Contenedor de SELECT grupo FROM a_grupo_cantidad.
$aGrupos = $shop->getArrAux();

$aProducts = array();
$shop->TabsSliderProducts();
$aProducts = $shop->getArrAux();

/* VARIABLES */
$num_rows = 0; //Count rows.
$html = ''; //Contenedor Html.
$resto = 0; //Cantidad de elementos por poner
$inicio = 0; //Empieza a colocar elementos desde elemento
$actual = 0; //Valor hasta donde a colocado elementos
$no_spaces = ''; //String sin espacios
$first_loop = ''; //Pone classe .active nav nav-tabs nav_tab_line
$count = 0; //count #product-tabs-slider

/* FUNCION */

$num_rows = count($aGrupos);
$resto = $num_rows;
$inicio = $num_rows - $num_rows;
$actual = 0;

$cnt = 0; //Contador hasta $numero_filas.
$sNameGroup = ''; //Indica Grupo

a(); //HTML productsTabsSlider.php

while ($resto > 0) {
    if ($resto > $numero_filas) {
        $actual = $inicio + $numero_filas;
    } else {
        $actual = $resto + $inicio;
    }
//
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
//
    d(); //HTML productsTabsSlider.php

    for ($i = $inicio; $i < $actual; $i++) {

        if ($i == $inicio) {
            $first_loop = ' active';
        } else {
            $first_loop = '';
        }

        $no_spaces = str_replace(' ', '_', $aGrupos[$i]['grupo']);
//        
//        //-----LEVEL 2--INSIDE----/
//        //DEL PRIMER GRUPO PONE TODOS LOS PRODUCTOS SALTA HASTA $numero_filas Y VUELVEA PONER TODOS PRODUCTOS
        //if ($cnt < $numero_filas && $aGrupos[$i]['grupo'] != $sNameGroup) {
        e($first_loop, $no_spaces); //HTML productsTabsSlider.php   
        product_tabs_slider_lvl_2($aProducts, $aGrupos[$i]['grupo']);
        e2();
        // if($cnt == $numero_filas ) $cnt=0;
        //}
//        //$cnt++;
    }
//}
//
    f(); //HTML productsTabsSlider.php

    $resto = $resto - $numero_filas;
    $inicio = $inicio + $numero_filas;

    g(); //HTML productsTabsSlider.php
//-----LEVEL 2--INSIDE----//
}

function product_tabs_slider_lvl_2($aProducts, $grupo) {
//    // $sql='SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products;';
//    var_dump($grupo);
    $string_vNO = "vNO=N&";
    $data_valor_oferta = "N";
    $sGrupo = $grupo;

    foreach ($aProducts as $elem) {
        if ($sGrupo == $elem['grupo']) {
            if ($elem["valor_oferta"] == 1) {
                $string_vNO = "vNO=O&";
                $data_valor_oferta = "O";
            }

            e1($string_vNO, $data_valor_oferta, $elem['codigo_producto'], $elem['nombre_producto'], $elem['pvp'], $elem['pvp_incrementado'], $elem['imagen'], $elem['valor_oferta']);
        }
    }
}
