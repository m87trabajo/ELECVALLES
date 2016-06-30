<?php

require_once 'Controller/Errors/funcErrPDOCatch.php';

Class daoShop {

    //------------------------MENU-------------------------------//
    //------TABLA:a_grupo_cantidad,a_grupo_oferta_cantidad------//
    public function FetchMenuGroupsQuantitys($table) {

        try {
            $con = new DBConnection();
            $sql = 'SELECT grupo,cantidad FROM ' . $table . ';';
            $response = $con->getAll($sql);
        } catch (Exception $e) {
            ErrPDOCatch(get_class($this) . '-->FetchMenuGroupsQuantitys()', $e->getMessage(), $e->getCode());
            exit();
        }
        return $response;
    }

    //--------------------TABS SLIDER--------------------------//
    //------TABLA:a_grupo_cantidad-----------------------------//
    public function FetchGroups() {

        try {
            $con = new DBConnection();
            $sql = 'SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC;';
            $response = $con->getAll($sql);
        } catch (Exception $e) {
            ErrPDOCatch(get_class($this) . '-->FetchGroups()', $e->getMessage(), $e->getCode());
            exit();
        }
        return $response;
    }
    
    //--------------------TABS SLIDER--------------------------//
    //------TABLA:f_random_products------/
    public function FetchProductsByGroup($CantTabsSlider, $CantTabs, $CntGroups) {

        try {
            $con = new DBConnection();
            $aGroups = array();
            $response = array();
            $groupsSelected = $CantTabsSlider * $CantTabs;

            if ($groupsSelected > 0) {//ERROR:Evita valores errores en parametros ($CantTabsSlider || $CantTabs) == 0
                if ($CantTabs > $CntGroups) {//Si se intenta poner mas tabs que grupos pone todos los grupos
                    $CantTabs = 1;
                }
                //ERROR:Si ponemos $CantTabsSlider=20, $CantTabs = 1 sale por condicion $i < $groups['count'] evitamos error [18]=> bool(false) [19]=> bool(false)
                //Si ponemos $CantTabsSlider=2 $CantTabs = 4 sale por condicion $i < $groupsSelected. Pone 2 TabSlider con 4 grupos y sale.Evita poner todos los grupos.

                for ($i = 0; $i < $groupsSelected && $i < $CntGroups; $i = $i + $CantTabs) {
                    $sql_1 = 'SELECT DISTINCT grupo FROM a_grupo_cantidad ORDER BY grupo ASC LIMIT :i,1;';
                    $query = $con->getConn()->prepare($sql_1);
                    $query->bindParam(":i", $i, PDO::PARAM_INT);
                    array_push($aGroups, $con->executeQueryOne($query));
                }

                foreach ($aGroups as $value) {
                    $sql = 'SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;';
                    $query = $con->getConn()->prepare($sql);
                    $query->bindParam(":group", $value['grupo']);
                    array_push($response, $con->executeQueryAll($query));
                }
            }
        } catch (Exception $e) {
            ErrPDOCatch(get_class($this) . '-->FetchProducts()', $e->getMessage(), $e->getCode());
            exit();
        }
        return $response;
    }
    
    //--------------------TABS SLIDER--------------------------//
    //------TABLA:f_random_products------/
    public function FetchGroupProducts($group) {

        try {
            $con = new DBConnection();
            $sql = 'SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;';
            $query = $con->getConn()->prepare($sql);
            $query->bindParam(":group", $group);
            $response = $con->executeQueryAll($query);
        } catch (Exception $e) {
            ErrPDOCatch(get_class($this) . '-->FetchGroupProducts()', $e->getMessage(), $e->getCode());
            exit();
        }
        return $response;
    }

}
?>

