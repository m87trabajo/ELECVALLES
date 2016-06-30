<?php

Class Shop {

    private $CompanyName;
    private $ArrAux = null;
    private $VarAux = 0;

    function __construct($CompanyName) {
        $this->setCompanyName($CompanyName);
        $this->setArrAux(array());
        //echo "Shop-->Construido<br/>";
    }

    function __destruct() {
        //echo "Shop-->Destruido<br/>";
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

    function getVarAux() {
        return $this->VarAux;
    }

    function setVarAux($VarAux) {
        $this->VarAux = $VarAux;
    }

    //------------------------MENU-------------------------------/
    public function MenuGroupsQuantitys($table) {
        $daoshop = new daoShop();
        $FetchMenuGroupsQuantitys = $daoshop->FetchMenuGroupsQuantitys($table);
        $this->setArrAux($FetchMenuGroupsQuantitys);
    }

    //--------------------TABS SLIDER--------------------------//
    public function TabsSliderGroups() {
        $daoshop = new daoShop();
        $FetchGroups = $daoshop->FetchGroups();
        $this->setArrAux($FetchGroups);
    }

    //--------------------TABS SLIDER--------------------------//
    public function TabsSliderProductsByGroup($CantTabsSlider, $CantTabs, $CntGroups) {
        $daoshop = new daoShop();
        $FetchProductsByGroup = $daoshop->FetchProductsByGroup($CantTabsSlider, $CantTabs, $CntGroups);
        $this->setArrAux($FetchProductsByGroup);
    }

    //--------------------TABS SLIDER--------------------------//
    public function TabsSliderAjaxRequestGroupProducts($group) {
        $daoshop = new daoShop();
        $FetchGroupProducts = $daoshop->FetchGroupProducts($group);
        $this->setArrAux($FetchGroupProducts);
    }

}
