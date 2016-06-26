<?php
require_once 'funcAutoload.php';
//
///* ======================================= 
//  OBJETO
//  ======================================== */
$shop = new Shop('aux');
$shop->TabsSliderAjaxRequestGroupProducts($_POST['product_code']); //'SELECT grupo FROM a_grupo_cantidad;'
$aGroupProducts = $shop->getArrAux(); //Contenedor de SELECT grupo FROM a_grupo_cantidad.
//echo "hola".$aGroupProducts[0]['grupo'];
//var_dump($aGroupProducts);
//
//
//$a="hola";
//echo "hola";
//

    die(json_encode($aGroupProducts)); //exit and output content


