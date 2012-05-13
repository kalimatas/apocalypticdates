<?php

class IndexControllerTest extends PHPUnit_ControllerTestCase
{
    public function setUpDatabase()
    {
        $this->setUpConnectionAndTester();

        $databaseFixture = new PHPUnit_Extensions_Database_DataSet_YamlDataSet(TESTS_PATH . '/application/models/Author/_files/author.yml');
        $databaseFixture->addYamlFile(TESTS_PATH . '/application/models/Date/_files/date.yml');

        $this->_simpleTester->setupDatabase($databaseFixture);
    }

    public function testIndexAction()
    {
        $params = array('action' => 'index', 'controller' => 'Index', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
    }

    /**
     * Trying to create a date without data. Should fail.
     */
    public function testCreateFailAction()
    {
        $this->dispatch('/index/new/');

        $this->assertModule('default');
        $this->assertController('error');
        $this->assertAction('error');

        // we must see an error message
        $this->assertQueryContentContains("div#content h3", "No data given for new date.");
    }

    /**
     * Trying to create a date with invalid author_id. In out test DB
     * we have only two authors now.
     */
    public function testInvalidAuthorAction()
    {
        $this->getRequest()->setMethod(Zend_Http_Client::POST);
        $this->getRequest()->setPost(array(
            'author_id' => 42, // no such author_id in fixture author.yml
            'date' => 'Some year',
            'description' => 'This date cannot happen without author :))',
        ));

        $this->dispatch('/index/new/');

        $this->assertModule('default');
        $this->assertController('error');
        $this->assertAction('error');

        // we must see an error message
        $this->assertQueryContentContains("div#content h3", "Author with id \"42\" doesn't exist.");
    }

    /**
     * Create new date.
     */
    public function testCreateAction()
    {
        $this->getRequest()->setMethod(Zend_Http_Client::POST);
        $this->getRequest()->setPost(array(
            'author_id' => 1,
            'date' => 'New year',
            'description' => 'As usual',
        ));

        $this->dispatch('/index/new/');

        // we should not see an error page, but default index
        $this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('new');

        // we must see an "ok" message
        $this->assertQueryContentContains("div#content h4", "ok");
    }
}