<?php

/* ##################################################################################################
  ###################################################################################################
  AUTOR:ELCACHO GRNADOS,MARC
  FEHCA:07-07-2016
  VERSION:V.0.1
  TITULO:SessionBase.inc.php
  RETRUN:$_SESSION['shop']['oShop'] = serialize($shop);
  VENTAJAS:Solo se crea un objeto shop por user en index.php,utilizado por AJAXGroupTabSlider.php,
  AJAXNavTabSlider
  RESUMEN:session_start(), devuelve $_SESSION['shop'],publicPath,oShop,a_grupo_cantidad
  DATABASE:SI
  FUNCIONAMIENTO:
  -Es llamada por index.php en la primera lina
  -todos los archivos cargados a traves de index.php tienen la session_start()
  -Crea un objeto $shop = new Shop('aux');
  -Serializa el objeto y guarda en variable $_SESSION['shop']['oShop']
  ERRORES:
  ---!IMPORTANTE!---:
  ##################################################################################################
  ################################################################################################## */

/* ======================================= 
  SESSION
  ======================================== */
session_start();
//if (!isset($_SESSION['shop'])) {
    $_SESSION['shop'] = [
        'publicPath' => 'C:/xampp/htdocs/ELECVALLES',
        'oShop' => '',
        'a_grupo_cantidad' => '',
        'a_grupo_oferta_cantidad' => ''
    ];
//}


/* ======================================= 
  INCLUDES
  ======================================== */
require_once $_SESSION['shop']['publicPath'] . "/Controller/funcAutoload.php";

/* ======================================= 
  OBJETO
  ======================================== */
$shop = new Shop('aux');

/* ======================================= 
  VARIABLES
  ======================================== */
$_SESSION['shop']['oShop'] = serialize($shop);

