<?php
/* ##################################################################################################
  ###################################################################################################
  AUTOR:ELCACHO GRNADOS,MARC
  FEHCA:00-00-2016
  VERSION:V.0.0
  TITULO:
  RETRUN:  
  VENTAJAS:
  RESUMEN:
  DATABASE:
  FUNCIONAMIENTO:
  ERRORES:
  ---!IMPORTANTE!---:
  No puede haber echo desde el momento en que controller AJAXGroupTabSlider.php se inicia
  porque el dato es de typo json el que espera recibir View/mainIndex.js.
  ##################################################################################################
  ################################################################################################## */
/* ======================================= 
  SESSION
  ======================================== */
session_start();//Estos no son llamados por index.php ni son hijos es llamado por mainIndex.js

/* ======================================= 
  INCLUDES
  ======================================== */
require_once 'funcAutoload.php';
require_once $_SESSION['shop']['publicPath'] .'/Config/Customize.php';

/* ======================================= 
  OBJETO
  ======================================== */
$shop = new Shop('aux');
$resultContainer=array();
$shop->TabsSliderGroups();
$aGroups = $shop->getArrAux();  //SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC;
$CounGroups = count($aGroups);   //Total Grupos    
//var_dump($aGroups);///----DEBUG---
array_push($resultContainer, $IN_NumTabs,$CounGroups);

/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */
die(json_encode($resultContainer, JSON_UNESCAPED_UNICODE )); //exit and output content
