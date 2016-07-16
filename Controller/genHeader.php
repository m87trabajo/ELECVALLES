<?php
/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:00-00-2016    -VERSION:V.0.0    -LENGUAJE:JAVASCRIPT
  -TITULO:Controller/genHeader.php
  -RETRUN: ---
  -VENTAJAS:No crea objeto
  -RESUMEN:Crea el menu con los nombres en en array y grupos de DB en filas segun $IN_NumeroFilas
  -DATABASE:---
  -FUNCIONAMIENTO:---
  -ERRORES:
  Pequeño bug que hace page jump cuando clicamos en un nav tab del slider.
  ---!IMPORTANTE!---:
  session esta iniciada desde index.php
  ##################################################################################################
  ################################################################################################## */

/* ======================================= 
  INCLUDES
  ======================================== */
require_once 'funcAutoLoad.php';
require_once 'Config/Customize.php';
require_once $_SESSION['shop']['publicPath'] .'/View/html/header.php';
/* ======================================= 
  AJUSTAR SEGUN PREFERENCIAº
  ======================================== */
/*******************HELP*****************************************
 $IN_NumeroFilas = 7; //Numero de filas aparezen en menu 
 $IN_aNameMenu=['PRODUCTOS','OFERTAS','SERVICIOS','NOTICIAS']; 
*****************************************************************/

/* ======================================= 
  OBJETO
  ======================================== */
//$shop = new Shop('aux');

/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES FUNCION */
$aGrupoCantidad = $_SESSION['shop']['a_grupo_cantidad']; //SELECT grupo,cantidad FROM a_grupo_cantidad.
$aOfertaGrupoCantidad = $_SESSION['shop']['a_grupo_oferta_cantidad']; //SELECT grupo,cantidad FROM a_grupo_oferta_cantidad


/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */


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

        if ($resto < $IN_NumeroFilas) {
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