<?php

/* ##################################################################################################
  ###################################################################################################
  AUTOR:ELCACHO GRNADOS,MARC
  FEHCA:30-06-2016
  VERSION:V.0.3
   TITULO:Controller/generateProductsTabslider.php
  FUNCIONAMIENTO:
  SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC.Y sabemos cuantos grupos ahy.
  Segun variables preferencia $CantTabsSlider y $CantTabs. Llama a DB.
  Si ahy 4 tabs por slider cojera el grupo 1,5,9 ...
  SELECT DISTINCT grupo FROM a_grupo_cantidad ORDER BY grupo ASC LIMIT :i,1;
  Solo se cargan la primera tab del slider con productos. Los otros tabs se cargan mediante AJAX.
  SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;
  Mostramos producto en el tab correspondiente.
  ##################################################################################################
  ################################################################################################## */

/* ======================================= 
  INCLUDES
  ======================================== */

require_once 'funcAutoLoad.php';
require_once 'View/html/productsTabsSlider.php';

/* ======================================= 
  AJUSTAR SEGUN PREFERENCIA
  ======================================== */

$CantTabsSlider = 2; //Cantidad de tab slider       ///0///1///1///1///18///36///1
$CantTabs = 4; //Cantidad de tabs en tabs slider   ///0///0///1///18///1///1///36

/* ======================================= 
  OBJETO
  ======================================== */
$shop = new Shop('aux');
$shop->TabsSliderGroups();
$aGroups = $shop->getArrAux();  //SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC;
$CntGroups = count($aGroups);   //Contador Grupos    

$shop->TabsSliderProductsByGroup($CantTabsSlider, $CantTabs, $CntGroups);   //SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;
$aProductsByGroups = $shop->getArrAux();

/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES HTML */
$Html = ''; //Contenedor Html.
$NoSpaces = ''; //String sin espacios
$FirstLoop = ''; //Pone classe .active nav nav-tabs nav_tab_line

/* VARIABLES FUNCION */
$Resto = $CntGroups; //Cantidad de elementos por poner
$Inicio = $CntGroups - $CntGroups; //Empieza a colocar elementos desde elemento
$Actual = 0; //Valor hasta donde a colocado elementos

$VarCantTabsSlider = $CantTabsSlider;   //Cuenta tabs slider puestos (decrementa)
$Cnt = 0;   //Cuenta tabs slider puestos (aumenta)

/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */

A(); //HTML productsTabsSlider.php

while ($VarCantTabsSlider > 0 && $CantTabs > 0 && ($Cnt * $CantTabs) <= ($CntGroups - 1)) {//Si se pone variable resto pone todos los grupos    
    if ($Resto > $CantTabs) {                       ///18>4///14>4///10>8///6>4
        $Actual = $Inicio + $CantTabs;              ///0+4=4///4+4=8///8+4=12///12+4=16
    } elseif ($Resto < $CantTabs) {                 ///2<4///
        $Actual = $Resto + $Inicio;                 ///2+16=18
    }

    B(); //ABRE <section> HTML productsTabsSlider.php

    for ($i = $Inicio; $i < $Actual; $i++) {        ///0-->4///4-->8///8-->12///12-->16///16-->18
        if ($i == $Inicio) {
            $FirstLoop = 'class="active"';
        } else {
            $FirstLoop = '';
        }
        $NoSpaces = str_replace(' ', '_', $aGroups[$i]['grupo']);
        C($FirstLoop, $NoSpaces, $aGroups[$i]['grupo']); //ABRE ul.nav-tabs HTML productsTabsSlider.php
    }
    D();

    $NoSpaces = str_replace(' ', '_', $aProductsByGroups[$Cnt][0]['grupo']);

    //-----LEVEL 2--INSIDE----//
    E($NoSpaces); //ABRE div.tab-content HTML productsTabsSlider.php   
    ProductTabsSliderLvl_2($aProductsByGroups[$Cnt]); //ABRE Y CIERRA div.item-carousel
    E_2(); //cierra div.tab-content

    $VarCantTabsSlider--;
    $Cnt++;
    $Resto = $Resto - $CantTabs;                    ///18-4=14///14-4=10///10-4=6///6-4=2///
    $Inicio = $Inicio + $CantTabs;                  ///0+4=4///4+4=8///8+4=12///12+4=16

    F(); //CIERRA <section> HTML productsTabsSlider.php
}
G(); //HTML productsTabsSlider.php

/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */

function ProductTabsSliderLvl_2($aProductsByGroup) {

    $string_vNO = "vNO=N&";
    $data_valor_oferta = "N";
    foreach ($aProductsByGroup as $producto) {

        if ($producto["valor_oferta"] == 1) {
            $string_vNO = "vNO=O&";
            $data_valor_oferta = "O";
        }
        E_1($string_vNO, $data_valor_oferta, $producto['codigo_producto'], $producto['nombre_producto'], $producto['pvp'], $producto['pvp_incrementado'], $producto['imagen'], $producto['valor_oferta']);
    }
}
