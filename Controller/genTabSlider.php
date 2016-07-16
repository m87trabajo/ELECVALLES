<?php

/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:07-07-2016    -VERSION:V.0.3    -LENGUAJE:PHP
  -TITULO:Controller/genTabslider.php
  -RETRUN:
  -VENTAJAS:Crea Objeto porque tiene peticiones AJAX
  -RESUMEN:
  -DATABASE:SI
  -FUNCIONAMIENTO:
  SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC.Y sabemos cuantos grupos ahy.
  Segun variables preferencia $IN_NumTabsSlider y $IN_NumTabs. Llama a DB.
  Si ahy 4 tabs por slider cojera el grupo 1,5,9 ...
  SELECT DISTINCT grupo FROM a_grupo_cantidad ORDER BY grupo ASC LIMIT :i,1;
  Solo se cargan la primera tab del slider con productos. Los otros tabs se cargan mediante AJAX.
  SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;
  Mostramos producto en el tab correspondiente.
  -ERRORES:
  Pequeño bug que hace page jump cuando clicamos en un nav tab del slider.
  ---!IMPORTANTE!---:
 * session esta iniciada desde index.php
  ##################################################################################################
  ################################################################################################## */

/* ======================================= 
  INCLUDES
  ======================================== */
require_once 'funcSessionStarted.php'; //En este caso si que es llamdao por index.php pero tmb por AJAXGroupTabSlider no son llamados por index.php es llamado por mainIndex.js
require_once 'funcAutoLoad.php';
require_once $_SESSION['shop']['publicPath'] . '/Config/Customize.php';
require_once $_SESSION['shop']['publicPath'] . '/View/html/tabSlider.php';

/* ======================================= 
  AJUSTAR SEGUN PREFERENCIA
  ======================================== */
/* * *****************HELP*****************************************
  $IN_NumTabsSlider = 1; //Cantidad de tab slider       ///0///1///1///1///18///36///1
  $IN_NumTabs = 4; //Cantidad de tabs en tabs slider   ///0///0///1///18///1///1///36
 * *************************************************************** */

/* ======================================= 
  OBJETO
  ======================================== */
$oShop = unserialize($_SESSION['shop']['oShop']);
//$oShop->TabsSliderGroups();

/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES HTML */
$Html = ''; //Contenedor Html.
$NoSpaces = ''; //String sin espacios
$FirstLoop = ''; //Pone classe .active nav nav-tabs nav_tab_line

/* VARIABLES FUNCION */
$aGroups = $_SESSION['shop']['$aGroups'];  //SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC;
$CounGroups = $_SESSION['shop']['$CounGroups'];   //Total Grupos    

/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */
//$oShop, $aGroups, $IN_NumTabsSlider, $IN_NumTabs, $CounGroups, $start
if ($_POST) {
    if (isset($_POST['TrackLoad'])) {

        $IN_NumTabsSlider = 1; //Cantidad de tab slider       ///0///1///1///1///18///36///1
        $IN_NumTabs = 4; //Cantidad de tabs en tabs slider   ///0///0///1///18///1///1///36

        $elem = $_POST['TrackLoad'] * $IN_NumTabs;
        genTabSlider_AJAX($oShop, $aGroups, $IN_NumTabsSlider, $IN_NumTabs, $CounGroups, $elem);
    } elseif (isset($_POST['nameGroupUnderScore'])) {
        generateGroupTabSlider_AJAX($_POST['GroupItem'], $_POST['nameGroupUnderScore']);
    }
} else {
    genTabSlider_PHP($oShop, $aGroups, $IN_NumTabsSlider, $IN_NumTabs, $CounGroups, 0);
}

/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */

function genTabSlider_PHP($oShop, $aGroups, $IN_NumTabsSlider, $IN_NumTabs, $CounGroups, $start) {
    /* ======================================= 
      OBJETO
      ======================================== */
    $groupsSelected = $IN_NumTabsSlider * $IN_NumTabs;
    //$groupsSelected = $IN_NumTabs * ($IN_NumTabsSlider) + 1; ///----DEBUG---FUTURO SELECIONARAS X:
    if ($IN_NumTabs <= 0 || $IN_NumTabsSlider <= 0) {
        die('Error:Controller/genTabSlider.php<br/>$IN_NumTabs<=0 || $IN_NumTabsSlider<=0');
    }
    if ($IN_NumTabs > $CounGroups) {//Si se intenta poner mas tabs que grupos pone todos los grupos
        $IN_NumTabs = 1;
    }
    if ($IN_NumTabs * $IN_NumTabsSlider > $CounGroups) {
        $$groupsSelected = $CounGroups;
    }

//    echo '$start' . $start . '<br/>';///----DEBUG---
//    echo '$groupsSelected' . $groupsSelected . '<br/>';///----DEBUG---
//    echo '$IN_NumTabs' . $IN_NumTabs . '<br/>';///----DEBUG---

    $oShop->TabsSliderProductsByGroup($start, $groupsSelected, $IN_NumTabs);   //SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;
    $aProductsByGroups = $oShop->getArrAux();

    /* VARIABLES FUNCION */
    $Resto = $CounGroups; //Cantidad de elementos por poner
    $Inicio = $start; //Empieza a colocar elementos desde elemento
    $Actual = 0; //Valor hasta donde a colocado elementos

    $VarCantTabsSlider = $IN_NumTabsSlider;   //Cuenta tabs slider puestos (decrementa)
    $Cnt = 0;   //Cuenta tabs slider puestos (aumenta)
    //
    A_0_TBS();//HTML <div id = "Main"> ABIERO View/html/header.php

    while ($VarCantTabsSlider > 0 && $IN_NumTabs > 0 && ($Cnt * $IN_NumTabs) <= ($CounGroups - 1)) {//Si se pone variable resto pone todos los grupos    
        A_TBS($aGroups[$Inicio]['grupo']); //ABRE <section> HTML tabSlider.php

        ProductTabsSliderLvl_1($aGroups, $aProductsByGroups[$Cnt], $IN_NumTabs, $Inicio, $Resto);

        $VarCantTabsSlider--;
        $Cnt++;
        $Resto = $Resto - $IN_NumTabs;                    ///18-4=14///14-4=10///10-4=6///6-4=2///
        $Inicio = $Inicio + $IN_NumTabs;                  ///0+4=4///4+4=8///8+4=12///12+4=16
        G_TBS(); //CIERRA <section> HTML tabSlider.php
    }

    A_1_TBS();//HTML <div id = "Main"> CERRADO View/html/footer.php
}

;

function genTabSlider_AJAX($oShop, $aGroups, $IN_NumTabsSlider, $IN_NumTabs, $CounGroups, $start) {
    /* ======================================= 
      OBJETO
      ======================================== */
    if ($IN_NumTabsSlider > 1) {
        $IN_NumTabsSlider = 1;
    }

    if ($start >= $CounGroups) {
        $start = $CounGroups - 1;
    }

    //echo '$start' . $start . '<br/>';///----DEBUG---
    //echo '$IN_NumTabs' . $IN_NumTabs . '<br/>';///----DEBUG---

    $oShop->TabsSliderProductsByGroup($start, $start + 1, $IN_NumTabs);   //SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;
    $aProductsByGroups = $oShop->getArrAux();

    /* VARIABLES FUNCION */
    $Resto = $CounGroups - $start; //Cantidad de elementos por poner
    // $start; //Empieza a colocar elementos desde elemento

    A_TBS($aGroups[$start]['grupo']); //ABRE <section> HTML tabSlider.php

    ProductTabsSliderLvl_1($aGroups, $aProductsByGroups[0], $IN_NumTabs, $start, $Resto);


    G_TBS(); //CIERRA <section> HTML tabSlider.php
}

;

function generateGroupTabSlider_AJAX($aGroupProducts, $nameGroupUnderScore) {
    // D_TBS();
//-----LEVEL 2--INSIDE----//
    E_TBS($nameGroupUnderScore); //ABRE div.tab-content HTML tabSlider.php   
    ProductTabsSliderLvl_2($aGroupProducts); //ABRE Y CIERRA div.item-carousel
    E_2_TBS(); //cierra <!-- /.tab-pane -->
}

;
/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */

function ProductTabsSliderLvl_1($aGroups, $aProductsByGroups, $IN_NumTabs, $Inicio, $Resto) {

    $Actual = $Inicio + $IN_NumTabs;
    if ($Resto > $IN_NumTabs) {                       ///18>4///14>4///10>8///6>4
        $Actual = $Inicio + $IN_NumTabs;              ///0+4=4///4+4=8///8+4=12///12+4=16
    } elseif ($Resto < $IN_NumTabs) {                 ///2<4///
        $Actual = $Resto + $Inicio;                 ///2+16=18
    }

//echo $aGroups['grupo'];
    for ($i = $Inicio; $i < $Actual; $i++) {        ///0-->4///4-->8///8-->12///12-->16///16-->18
        if ($i == $Inicio) {
            $FirstLoop = 'class="hide"';
        } else {
            $FirstLoop = '';
        }
        $NoSpaces = str_replace(' ', '_', $aGroups[$i]['grupo']);
        B_TBS($FirstLoop, $NoSpaces, $aGroups[$i]['grupo']); //ABRE ul.nav-tabs HTML tabSlider.php
    }
    C_TBS();

    $NoSpaces = str_replace(' ', '_', $aProductsByGroups[0]['grupo']);
    D_TBS();
//-----LEVEL 2--INSIDE----//
    E_TBS($NoSpaces); //ABRE div.tab-content HTML tabSlider.php   
    ProductTabsSliderLvl_2($aProductsByGroups); //ABRE Y CIERRA div.item-carousel
    E_2_TBS(); //cierra <!-- /.tab-pane -->
    F_TBS(); //cierra div.tab-content
}

function ProductTabsSliderLvl_2($aProductsByGroup) {

    $string_vNO = "vNO=N&";
    $data_valor_oferta = "N";
    $sHotNewSale = 'sale'; //Modificar tmb en handmade.js 

    foreach ($aProductsByGroup as $producto) {

        if ($producto["valor_oferta"] == 1) {
            $string_vNO = "vNO=O&";
            $data_valor_oferta = "O";
            $sHotNewSale = 'hot';
        }
        E_1_TBS($string_vNO, $data_valor_oferta, $producto['codigo_producto'], $producto['nombre_producto'], $producto['pvp'], $producto['pvp_incrementado'], $producto['imagen'], $sHotNewSale);
    }
}
