<?php

class IndexController extends Zend_Controller_Action
{
    /**
     * List all dates
     */
    public function indexAction()
    {
        $datesTable = new Apoc_Model_Date_Table();
        $this->view->dates = $datesTable->fetchAll();
    }

    /**
     * Create new date
     *
     * @throws Zend_Exception
     */
    public function newAction()
    {
        /** @var $request Zend_Controller_Request_Http */
        $request = $this->getRequest();

        if (!$request->isPost()) {
            throw new Zend_Exception('No data given for new date.');
        }

        $mustHaveFields = array(
            'author_id',
            'date',
            'description',
        );

        foreach ($mustHaveFields as $field) {
            $sentData = $request->getParam($field);
            if (is_null($sentData) || empty($sentData)) {
                throw new Zend_Exception('You must specify "' . $field . '" field.');
            }
        }

        // checking author
        $authorTable = new Apoc_Model_Author_Table();
        if (!$authorTable->fetchRow('id = ' . $request->getParam('author_id'))) {
            throw new Zend_Exception('Author with id "' . $request->getParam('author_id') . '" doesn\'t exist.');
        }

        // create new record
        $dateTable = new Apoc_Model_Date_Table();
        $date = $dateTable->createRow($request->getParams());
        $date->save();

        $this->view->status = 'ok';
    }
}