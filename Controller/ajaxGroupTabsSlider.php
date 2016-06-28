<?php

require_once 'funcAutoload.php';
/* ======================================= 
  ----------------IMPORTANTE--------------
  ========================================
  NO PUEDE HABER ECHO PORQUE SE MODIFICA EL JSON DATA
 */
///* ======================================= 
//  OBJETO
//  ======================================== */
$shop = new Shop('aux');
$shop->TabsSliderAjaxRequestGroupProducts($_POST['product_code']); //'SELECT grupo FROM a_grupo_cantidad;'
$aGroupProducts = $shop->getArrAux(); //Contenedor de SELECT grupo FROM a_grupo_cantidad.
//echo "a";
die(json_encode($aGroupProducts)); //exit and output content


