<?php

require_once 'Controller/Errors/funcErrPDOCatch.php';

Class daoShop {

    //------TABLA:a_grupo_cantidad,a_grupo_oferta_cantidad------/
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

    //------TABLA:a_grupo_cantidad------/
    public function FetchGroups() {

        try {
            $con = new DBConnection();
            $sql = 'SELECT grupo FROM a_grupo_cantidad;';
            $response = $con->getAll($sql);
        } catch (Exception $e) {
            ErrPDOCatch(get_class($this) . '-->FetchGroups()', $e->getMessage(), $e->getCode());
            exit();
        }
        return $response;
    }

    //------TABLA:f_random_products------/
    public function FetchProducts() {

        try {
            $con = new DBConnection();
            $sql = 'SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products ORDER BY grupo ASC;';
            $response = $con->getAll($sql);
        } catch (Exception $e) {
            ErrPDOCatch(get_class($this) . '-->FetchProducts()', $e->getMessage(), $e->getCode());
            exit();
        }
        return $response;
    }

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

