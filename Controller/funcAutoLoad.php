<?php
function __autoload($class_name){
    //$root = "/var/www/html/M07/Uf4/PHP-DAO";
    $curdir = getcwd();
    chdir($curdir);

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