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
    public function FetchProductsByGroup($start, $groupsSelected, $IN_NumTabs) {

        try {
            $con = new DBConnection();
            $aGroups = array();
            $response = array();


            for ($i = $start; $i < $groupsSelected; $i = $i + $IN_NumTabs) {
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
        } catch (Exception $e) {
            ErrPDOCatch(get_class($this) . '-->FetchProductsByGroup()', $e->getMessage(), $e->getCode());
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

    //--------------------Controller/genCarroCaja.php--------------------------//
    //------TABLA:productos------/
    public function FetchProductByNumProducto($numProducto) {

        try {
            $con = new DBConnection();
            $sql = 'SELECT nombre_producto,pvp,imagen FROM productos WHERE codigo_producto = :numProducto LIMIT 1';
            $query = $con->getConn()->prepare($sql);
            $query->bindParam(":numProducto", $numProducto);
            $response = $con->executeQueryAll($query);
        } catch (Exception $e) {
            ErrPDOCatch(get_class($this) . '-->FetchGroupProducts()', $e->getMessage(), $e->getCode());
            exit();
        }
        return $response;
    }

}


