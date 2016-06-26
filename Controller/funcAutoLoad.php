<?php
function __autoload($class_name){
    $root = "C:/xampp/htdocs/ELECVALLES";
    $curdir = getcwd();
    chdir($root);

    $nomBusiness="class".$class_name.".php";
    $nomDao=$class_name.".php";
    $arxiuDAO="Model/PersistentLayer/".$nomDao;
    $arxiuBusiness="Model/BusinessLayer/".$nomBusiness;

    if(file_exists($arxiuDAO)){
        require_once $arxiuDAO;
    }else{
       if(file_exists($arxiuBusiness)){
           require_once $arxiuBusiness;
       }
    }
    chdir($curdir);
}
?>