<?php

abstract class PHPUnit_ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * @var Zend_Test_PHPUnit_Db_Connection
     */
    protected $_connection;

    /**
     * @var Zend_Test_PHPUnit_Db_SimpleTester
     */
    protected $_simpleTester;

    /**
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_db;

    protected function setUp()
    {
        $this->bootstrap = TESTS_PATH . '/bootstrap.php';
        $this->setUpDatabase();
        parent::setUp();
    }

    protected function setUpConnectionAndTester()
    {
        if ($this->_connection == null) {
            $config = Zend_Registry::get('Config')->resources;
            $this->_db = Zend_Db_Table::getDefaultAdapter();

            // uncomment this line if you have foreign keys on columns,
            // otherwise you won't be able to truncate table
            //$this->_db->query("SET foreign_key_checks = 0");

            $this->_connection = new Zend_Test_PHPUnit_Db_Connection($this->_db, $config->db->params->dbname);
        }

        if ($this->_simpleTester == null) {
            $this->_simpleTester = new Zend_Test_PHPUnit_Db_SimpleTester($this->_connection);
        }
    }

    public function setUpDatabase()
    {
    }
}