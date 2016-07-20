<?php
/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:00-00-2016    -VERSION:V.0.0    -LENGUAJE:JAVASCRIPT
  -TITULO:index.php
  -RETRUN: ---
  -VENTAJAS:---
  -RESUMEN:---
  -DATABASE:---
  -FUNCIONAMIENTO:---
  -ERRORES:---
  Genera espacios vacios con CRLF entre <body><header>
  ---!IMPORTANTE!---:
  ##################################################################################################
  ################################################################################################## */
/* ======================================= 
  INCLUDES
  ======================================== */
require_once 'Config/SessionBase.inc.php'; //Crea session_start() aguas abajo.
require_once 'View/html/head.php'; //<html><body>
require_once 'Controller/genHeader.php'; //<header></header>
require_once 'Controller/genTabSlider.php';//<div id = "Main" class = "body-content">..<section></section>...
//require_once 'Controller/genFooter.php'; //<footer></footer><body>
require_once 'View/html/footerScripts.php'; //</body></html>