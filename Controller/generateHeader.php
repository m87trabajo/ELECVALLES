<?php

/* ##################################################################################################
  ###################################################################################################
  AUTOR:ELCACHO GRNADOS,MARC
  FEHCA:30-06-2016
  VERSION:V.0.3
  TITULO:
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
/* ======================================= 
  AJUSTAR SEGUN PREFERENCIA
  ======================================== */
$NumeroFilas = 7; //Numero de filas aparezen en menu
$aNameMenu=['PRODUCTOS','OFERTAS','SERVICIOS','NOTICIAS'];

/* ======================================= 
  OBJETO
  ======================================== */
$shop = new Shop('aux');


/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES HTML */
$html = ''; //Contenedor Html.

/* VARIABLES FUNCION */
$aGrupoCantidad = array(); //Contenedor de SELECT grupo,cantidad FROM a_grupo_cantidad.
$aOfertaGrupoCantidad= array();

$resto = 0; //Cantidad de elementos por poner
$inicio = 0; //Empieza a colocar elementos desde elemento
$actual = 0; //Valor hasta donde a colocado elementos
$NoSpaces = ''; //String sin espacios

/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */
$shop->MenuGroupsQuantitys('a_grupo_cantidad'); //SELECT grupo,cantidad FROM a_grupo_cantidad
$aGrupoCantidad = $shop->getArrAux();

$shop->MenuGroupsQuantitys('a_grupo_oferta_cantidad'); //SELECT grupo,cantidad FROM a_grupo_oferta_cantidad
$aOfertaGrupoCantidad = $shop->getArrAux();

A();
TopHeader();
MainHeader();
FH_1();
FH_2();
FH_3();
MenuItems($aGrupoCantidad,$NumeroFilas,$aNameMenu[0],'category_page.php?vNO=N&vGDFS=','active','col-xs-12 col-sm-12 col-md-12 col-lg-4','');
MenuItems($aOfertaGrupoCantidad,$NumeroFilas,$aNameMenu[1],'category_page.php?vNO=O&vGDFS=','','col-xs-12 col-sm-12 col-md-12 col-lg-6','Container_SM');
FH_5($aNameMenu[2],$aNameMenu[3]);
FH_6();
FH_7();
A_1();

/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */

function MenuItems($Response,$NumeroFilas,$ItemsNameMenu,$Href,$varCSS,$sCSS,$sCSS_2){
    
    $resto = count($Response);
    $inicio = 0;
    $actual = 0;
    
    FH_4_1($varCSS,$ItemsNameMenu,$sCSS_2);
    
    while ($resto > 0) {
        FH_4_2($sCSS);

        if ($resto > $NumeroFilas) {
            $actual = $inicio + $NumeroFilas;
        } else {
            $actual = $resto + $inicio;
        }

        for ($i = $inicio; $i < $actual; $i++) {
            $NoSpaces = str_replace(' ', '_', $Response[$i]['grupo']);
            FH_4_3($Response[$i]['grupo'],$Response[$i]['cantidad'],$Href,$NoSpaces);
        }

        FH_4_4();
        
        $resto = $resto - $NumeroFilas;
        $inicio = $inicio + $NumeroFilas;
    }  
    FH_4_5();
}


