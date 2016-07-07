<?php

/* ##################################################################################################
  ###################################################################################################
  AUTOR:ELCACHO GRNADOS,MARC
  FEHCA:07-07-2016
  VERSION:V.0.1
  TITULO:genHeader.php
  FUNCIONAMIENTO:
  ¡ADVERTENCIAS!:
 * PEQUEÑO BUG QUE HACE PAGE JUMP CUANDO AHY 2 TABS SLIDER

  ##################################################################################################
  ################################################################################################## */

/* ======================================= 
  INCLUDES
  ======================================== */
require_once 'funcAutoLoad.php';
require_once 'View/html/header.php';
require_once 'Config/Customize.php';
/* ======================================= 
  AJUSTAR SEGUN PREFERENCIAº
  ======================================== */
/* $IN_NumeroFilas = 7; //Numero de filas aparezen en menu */
/* $IN_aNameMenu=['PRODUCTOS','OFERTAS','SERVICIOS','NOTICIAS']; */

/* ======================================= 
  OBJETO
  ======================================== */
//$shop = new Shop('aux');

/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES FUNCION */
$oShop=  unserialize($_SESSION['shop']['oShop']);
$aGrupoCantidad = $_SESSION['shop']['a_grupo_cantidad']; //SELECT grupo,cantidad FROM a_grupo_cantidad.
$aOfertaGrupoCantidad = $_SESSION['shop']['a_grupo_oferta_cantidad']; //SELECT grupo,cantidad FROM a_grupo_oferta_cantidad

/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */

//SI COMPROBAMOS QUE NO EXISTA INFORMACION DEL MENU PARA NO HACER UNA PETICION A BASE DATOS
if (empty($aGrupoCantidad)) {
    $oShop->MenuGroupsQuantitys('a_grupo_cantidad'); //SELECT grupo,cantidad FROM a_grupo_cantidad
    $aGrupoCantidad = $oShop->getArrAux();
    //var_dump( $aGrupoCantidad);///----DEBUG---
}
if (empty($aOfertaGrupoCantidad)) {
    $oShop->MenuGroupsQuantitys('a_grupo_oferta_cantidad'); //SELECT grupo,cantidad FROM a_grupo_oferta_cantidad
    $aOfertaGrupoCantidad = $oShop->getArrAux();
    //var_dump( $aOfertaGrupoCantidad);///----DEBUG---   
}


/* MAIN */
A();
TopHeader();
MainHeader();
FH_1();
FH_2();
FH_3();
MenuItems($aGrupoCantidad, $IN_NumeroFilas, $IN_aNameMenu[0], 'category_page.php?vNO=N&vGDFS=', 'active', '', 'col-xs-12 col-sm-12 col-md-12 col-lg-4');
MenuItems($aOfertaGrupoCantidad, $IN_NumeroFilas, $IN_aNameMenu[1], 'category_page.php?vNO=O&vGDFS=', '', 'Container_SM', 'col-xs-12 col-sm-12 col-md-12 col-lg-6');
FH_5($IN_aNameMenu[2], $IN_aNameMenu[3]);
FH_6();
FH_7();
A_1();

/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */

function MenuItems($aGrupoCantidad, $IN_NumeroFilas, $IN_aNameMenu, $Href, $sCSS_1, $sCSS_2, $sCSS_2_3) {
    
    $resto = count($aGrupoCantidad); //Cantidad de elementos por poner
    $inicio = 0; //Empieza a colocar elementos desde elemento
    $actual = 0; //Valor hasta donde a colocado elementos
    $NoSpaces = ''; //String sin espacios


    FH_4_1($sCSS_1, $IN_aNameMenu, $sCSS_2);

    while ($resto > 0) {
        FH_4_2($sCSS_2_3);

        $actual = $inicio + $IN_NumeroFilas;
        
        if($resto < $IN_NumeroFilas){
            $actual = $resto + $inicio;
        }

        for ($i = $inicio; $i < $actual; $i++) {
            $NoSpaces = str_replace(' ', '_', $aGrupoCantidad[$i]['grupo']);
            FH_4_3($aGrupoCantidad[$i]['grupo'], $aGrupoCantidad[$i]['cantidad'], $Href, $NoSpaces);
        }

        FH_4_4();

        $resto = $resto - $IN_NumeroFilas;
        $inicio = $inicio + $IN_NumeroFilas;
    }
    FH_4_5();
}
