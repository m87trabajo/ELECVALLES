<?php
/*****************************************************************************************************/
/*****************************************************************************************************
AUTOR:ELCACHO GRNADOS MARC                                                                                                 
FEHCA:26-06-2016                                                                                                 
VERSION:V.0.1   
FUNCIONAMIENTO:
Lee grupos de tabla a_grupo_cantidad. Lee productos de tabla f_random_products.
Segun cantidad de tabla a_grupo_cantidad va desde el primer grupo hasta $numero_filas.
Para cada grupo que exista imprime func b() hasta func d().
Imprimie para cada grupo todos los productos que existan en f_random_products.         
*****************************************************************************************************/
/*****************************************************************************************************/
require_once 'funcAutoLoad.php';
require_once 'View/html/productsTabsSlider.php';
/* AJUSTAR SEGUN PREFERENCIA */
$numero_filas = 4; //EN MODO COLUMNA HACIA DERECHA
/* OBJETO */
$shop = new Shop('aux');
$shop->TabsSliderGroups(); //'SELECT grupo FROM a_grupo_cantidad;'
$aGrupos = array(); //Contenedor de SELECT grupo FROM a_grupo_cantidad.
$aGrupos = $shop->getArrAux();
$aProducts = array();
$shop->TabsSliderProducts(); //'SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products;';
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
        if ($i == $inicio) {
            $first_loop = ' active';
            $no_spaces = str_replace(' ', '_', $aGrupos[$i]['grupo']);
            e($first_loop, $no_spaces); //HTML productsTabsSlider.php   
            product_tabs_slider_lvl_2($aProducts, $aGrupos[$i]['grupo']);
            e2();
        }
        //break;
    }
    f(); //HTML productsTabsSlider.php
    $resto = $resto - $numero_filas;
    $inicio = $inicio + $numero_filas;
    g(); //HTML productsTabsSlider.php
   // break;
//-----LEVEL 2--INSIDE----//
}
function product_tabs_slider_lvl_2($aProducts, $grupo) {
//    // $sql='SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products;';
   // var_dump($aProducts);
    $string_vNO = "vNO=N&";
    $data_valor_oferta = "N";
    $cnt=0;
    $exit = false; //SI CAMBIA EL GRUPO Y YA HAVIA PUESTO SALE
   
    foreach ($aProducts as $clave => $valor ) {
        if ($grupo == $aProducts[$clave]['grupo']) {
            if ($aProducts[$clave]["valor_oferta"] == 1) {
                $string_vNO = "vNO=O&";
                $data_valor_oferta = "O";
            }
            e1($string_vNO, $data_valor_oferta, $aProducts[$clave]['codigo_producto'], $aProducts[$clave]['nombre_producto'], $aProducts[$clave]['pvp'], $aProducts[$clave]['pvp_incrementado'], $aProducts[$clave]['imagen'], $aProducts[$clave]['valor_oferta']);
            $exit = true;
           // var_dump($aProducts);
            
            //echo "ANTES:".count($aProducts);
            //unset($aProducts[$clave]);
             //echo "DESPUES:".count($aProducts);
          // var_dump($aProducts);
            
            // break;
        }else if($grupo != $aProducts[$clave]['grupo'] && $exit) break;
        //$cnt++;
    }
    //echo $cnt;
}