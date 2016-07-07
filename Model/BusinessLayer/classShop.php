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

    public function getCompanyName() {
        return $this->CompanyName;
    }

    public function setCompanyName($CompanyName) {
        $this->CompanyName = $CompanyName;
    }

    public function getArrAux() {
        return $this->ArrAux;
    }

    public function setArrAux($ArrAux) {
        $this->ArrAux = $ArrAux;
    }

    public function getVarAux() {
        return $this->VarAux;
    }

    public function setVarAux($VarAux) {
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
    //------TABLA:f_random_products------/
    public function TabsSliderProductsByGroup($start, $groupsSelected, $IN_NumTabs) {
        $daoshop = new daoShop();
        $FetchProductsByGroup = $daoshop->FetchProductsByGroup($start, $groupsSelected, $IN_NumTabs);
        $this->setArrAux($FetchProductsByGroup);
    }

    //--------------------TABS SLIDER--------------------------//
    //------TABLA:f_random_products------/
    public function TabsSliderAjaxRequestGroupProducts($group) {
        $daoshop = new daoShop();
        $FetchGroupProducts = $daoshop->FetchGroupProducts($group);
        $this->setArrAux($FetchGroupProducts);
        // var_dump($FetchGroupProducts);
    }

}
