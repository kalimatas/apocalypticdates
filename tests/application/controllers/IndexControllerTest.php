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

        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
    }
}