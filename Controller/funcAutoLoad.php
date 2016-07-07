<?php
/* ##################################################################################################
  ###################################################################################################
  AUTOR:ELCACHO GRNADOS,MARC
  FEHCA:00-00-2016
  VERSION:V.0.0
  TITULO:
  FUNCIONAMIENTO:
  ERRORES:
 *!IMPORTANTE!:
  ##################################################################################################
  ################################################################################################## */

/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */
function __autoload($class_name){

    $curdir = getcwd();
    chdir($_SESSION['shop']['publicPath']);

    $nomBusiness='class'.$class_name.'.php';
    $nomDao=$class_name.'.php';
    $arxiuDAO='Model/PersistentLayer/'.$nomDao;
    $arxiuBusiness='Model/BusinessLayer/'.$nomBusiness;

    if(file_exists($arxiuDAO)){
        require_once $arxiuDAO;
    }else{
       if(file_exists($arxiuBusiness)){
           require_once $arxiuBusiness;
       }
    }
    chdir($curdir);
}
