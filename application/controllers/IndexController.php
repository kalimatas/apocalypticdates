<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
        // list all dates
        $datesTable = new Apoc_Model_Date_Table();
        $this->view->dates = $datesTable->fetchAll();
    }
}