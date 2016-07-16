<?php
/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:07-07-2016    -VERSION:V.0.1    -LENGUAJE:PHP 
  -TITULO:Controller/AJAXGroupTabSlider.php
  -RETRUN:json_encode($aGroupProducts, JSON_UNESCAPED_UNICODE);
  -VENTAJAS:En ajax creamos objeto shop.
  -RESUMEN:Funcion ajax llamada por View/js/mainIndex.js
  -DATABASE:SI
  -FUNCIONAMIENTO:
  Session iniciada.
  Coje objeto shop de $_SESSION['shop']['oShop']
  SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;'
  ERRORES:
  ---!IMPORTANTE!---:
  No puede haber echo desde el momento en que controller AJAXTabSlider.php se inicia
  porque el dato es de typo json el que espera recibir View/mainIndex.js
  ##################################################################################################
  ################################################################################################## */

/* ======================================= 
  SESSION
  ======================================== */
session_start(); //Estos no son llamados por index.php ni son hijos es llamado por mainIndex.js

/* ======================================= 
  INCLUDES
  ======================================== */
require_once 'funcAutoload.php';

/* ======================================= 
  OBJETO
  ======================================== */
$shop = new Shop('aux');
/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES FUNCION */
//$shop = unserialize($_SESSION['shop']['oShop']);

$shop->TabsSliderAjaxRequestGroupProducts($_POST['nameGroup']); //'SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;''
$aGroupProducts = $shop->getArrAux(); //Contenedor de SELECT grupo FROM a_grupo_cantidad.
/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */
die(json_encode($aGroupProducts, JSON_UNESCAPED_UNICODE)); //exit and output content
