<?php

Class Shop {

    private $CompanyName;
    private $ArrAux = null;

    function __construct($CompanyName) {
        $this->setCompanyName($CompanyName);
        $this->setArrAux(array());
        echo "Shop-->Construido<br/>";
    }

    function __destruct() {
        echo "Shop-->Destruido<br/>";
    }

    function getCompanyName() {
        return $this->CompanyName;
    }

    function setCompanyName($CompanyName) {
        $this->CompanyName = $CompanyName;
    }

    function getArrAux() {
        return $this->ArrAux;
    }

    function setArrAux($ArrAux) {
        $this->ArrAux = $ArrAux;
    }

    public function MenuGroupsQuantitys($table) {
        $daoshop = new daoShop();
        $FetchMenuGroupsQuantitys = $daoshop->FetchMenuGroupsQuantitys($table);
        $this->setArrAux($FetchMenuGroupsQuantitys);
    }

    public function TabsSliderGroups() {
        $daoshop = new daoShop();
        $FetchGroups = $daoshop->FetchGroups();
        $this->setArrAux($FetchGroups);
    }

    public function TabsSliderProducts() {
        $daoshop = new daoShop();
        $FetchProducts = $daoshop->FetchProducts();
        $this->setArrAux($FetchProducts);
    }

    public function TabsSliderAjaxRequestGroupProducts() {
        $daoshop = new daoShop();
        $FetchProducts = $daoshop->FetchProducts();
        $this->setArrAux($FetchProducts);
    }

}
