<?php

/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:07-07-2016    -VERSION:V.0.1    -LENGUAJE:PHP
  -TITULO:Config/SessionBase.inc.php
  -RETRUN:$_SESSION['shop']['oShop'] = serialize($shop);
  -VENTAJAS:
  Solo se crea un objeto shop por user en index.php,utilizado por AJAXTabSlider.php,
  AJAXNavTabSlider
  -RESUMEN:session_start(), devuelve $_SESSION['shop'],publicPath,oShop,a_grupo_cantidad
  SI EXISTE $_SESSION['shop'] primera vez crea luego no.
  -DATABASE:SI
  -FUNCIONAMIENTO:
  Session iniciada.
  Es llamada por index.php en la primera lina
  todos los archivos cargados a traves de index.php tienen la session_start()
  Crea un objeto $shop = new Shop('aux');
  Serializa el objeto y guarda en variable $_SESSION['shop']['oShop']
  ERRORES:
  ---!IMPORTANTE!---:
  SOLO PUEDE SER LLAMADA POR index.php
  ##################################################################################################
  ################################################################################################## */

/* ======================================= 
  SESSION
  ======================================== */
session_start();
//echo getcwd()."<br>";///----DEBUG---
//echo $url = str_replace("\\","/",  getcwd());///----DEBUG---

if (!isset($_SESSION['shop'])) {//Si no existe var session la crea
    $_SESSION['shop'] = [
        'publicPath' => str_replace("\\", "/", getcwd()),
        'oShop' => '',
        'a_grupo_cantidad' => '',
        'a_grupo_oferta_cantidad' => '',
        '$aGroups' => '',
        '$CounGroups' => ''
    ];
}
//echo $_SESSION['shop']['publicPath'];///----DEBUG---

/* ======================================= 
  INCLUDES
  ======================================== */
require_once $_SESSION['shop']['publicPath'] . "/Controller/funcAutoload.php";

/* ======================================= 
  OBJETO
  ======================================== */
$shop = new Shop('aux');

//Llena variables a_grupo_cantidad, a_grupo_oferta_cantidad
$shop->MenuGroupsQuantitys('a_grupo_cantidad'); //SELECT grupo,cantidad FROM a_grupo_cantidad
$_SESSION['shop']['a_grupo_cantidad'] = $shop->getArrAux();
//echo( $_SESSION['shop']['a_grupo_cantidad']);///----DEBUG---


$shop->MenuGroupsQuantitys('a_grupo_oferta_cantidad'); //SELECT grupo,cantidad FROM a_grupo_oferta_cantidad
$aOfertaGrupoCantidad = $shop->getArrAux();
$_SESSION['shop']['a_grupo_oferta_cantidad'] = $shop->getArrAux();
//echo( $_SESSION['shop']['a_grupo_oferta_cantidad']);///----DEBUG---


/* VARIABLES FUNCION */
$shop->TabsSliderGroups();
$_SESSION['shop']['$aGroups'] = $shop->getArrAux();  //SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC;
$_SESSION['shop']['$CounGroups'] = count($_SESSION['shop']['$aGroups']);   //Total Grupos    

/* ======================================= 
  VARIABLES
  ======================================== */
$_SESSION['shop']['oShop'] = serialize($shop);

