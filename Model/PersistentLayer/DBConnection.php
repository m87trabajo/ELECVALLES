<?php

require_once 'Config/DBconfig.inc.php';
require_once 'Controller/Errors/funcErrPDOCatch.php';

class DBConnection extends PDO {

    private $conn; //contenedor connexion
    private $host;
    private $user;
    private $password;
    private $dataBaseName;
    private $error;
    private $debug;

    public function __construct() {
        $this->setConn(null);
        $this->setHost($GLOBALS['SERVER'] . ':' . $GLOBALS['PORT']);
        $this->setUser($GLOBALS['USER']);
        $this->setPassword($GLOBALS['PASSWORD']);
        $this->setDataBaseName($GLOBALS['DBNAME']);
        $this->connect();
    }

    public function connect() {
        if (!$this->getConn()) {
            try {
                $dsn = 'mysql:host=' . $this->getHost() . ';dbname=' . $this->getDataBaseName() . ';charset=utf8mb4';
                $this->setConn(new PDO($dsn, $this->getUser(), $this->getPassword()));
                $this->getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'DBConnection-->Conectado<br/>';
            } catch (PDOException $e) {
                ErrPDOCatch('DBConnection-->connect()', $e->getMessage(), $e->getCode());
                exit();
            }
        }
    }
    
    function __destruct() {
        echo 'DBConnection-->Desconectado<br/>';
        if ($this->getConn()) {
            $this->setConn(null);
        }
    }

    function getOne($query) {
        $result = $this->getConn()->prepare($query);
        if (!$result->execute()) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: ' . $query;
            die();
        }
        $reponse = $result->fetch(PDO::FETCH_ASSOC);
        return $reponse;
    }

    function getAll($query) {
        $result = $this->getConn()->prepare($query);
        if (!$result->execute()) {
            echo 'PDO::errorInfo():';
            echo '<br />';
            echo 'error SQL: ' . $query;
            die();
        }
        $reponse = $result->fetchAll(PDO::FETCH_ASSOC);
        return $reponse;
    }
       

    public function executeNonQuery($nonquery) {
        $nonquery->execute();
    }

    public function executeQueryOne($query) {
        $query->execute();
        $reponse = $query->fetch(PDO::FETCH_ASSOC);
        return $reponse;
    }

    public function executeQueryAll($query) {
        $query->execute();
        $reponse = $query->fetchAll(PDO::FETCH_ASSOC);
        return $reponse;
    }

    function getConn() {
        return $this->conn;
    }

    function getHost() {
        return $this->host;
    }

    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->password;
    }

    function getDataBaseName() {
        return $this->dataBaseName;
    }

    function getDebug() {
        return $this->debug;
    }

    function getError() {
        return $this->error;
    }

    function setConn($conn) {
        $this->conn = $conn;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setDataBaseName($dataBaseName) {
        $this->dataBaseName = $dataBaseName;
    }

    function setDebug($debug) {
        $this->debug = $debug;
    }

    function setError($error) {
        $this->error = $error;
    }

}

/* http://stackoverflow.com/questions/35368376/php-and-mysql-object-oriented */
/* http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers */
/*

$f->fetch() - Will get 1 row
$f->fetchAll() - Will get All rows
*/