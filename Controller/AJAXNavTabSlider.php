<?php
/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:07-07-2016    -VERSION:V.0.1    -LENGUAJE:PHP 
  -TITU
  -RETRUN:$IN_NumTabs,$CounGroups --> json_encode($aGroupProducts, JSON_UNESCAPED_UNICODE);
  -VENTAJAS:En ajax creamos objeto shop.
  -RESUMEN:Funcion ajax llamada por View/js/mainIndex.js
  -DATABASE:SI
  -FUNCIONAMIENTO:
  Session iniciada.
  Crea objeto shop-->Model
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
session_start();//Estos no son llamados por index.php ni son hijos es llamado por mainIndex.js

/* ======================================= 
  INCLUDES
  ======================================== */
//require_once 'funcAutoload.php';
require_once $_SESSION['shop']['publicPath'] .'/Config/Customize.php';

/* ======================================= 
  OBJETO
  ======================================== */
//$shop = new Shop('aux');
//$shop->TabsSliderGroups();
/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES FUNCION */
$resultContainer=array();
$aGroups = $_SESSION['shop']['$aGroups'] ;  //SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC;
$CounGroups = $_SESSION['shop']['$CounGroups'];   //Total Grupos    


/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */
//var_dump($aGroups);///----DEBUG---
array_push($resultContainer, $IN_NumTabs,$CounGroups);
die(json_encode($resultContainer, JSON_UNESCAPED_UNICODE )); //exit and output content


/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */