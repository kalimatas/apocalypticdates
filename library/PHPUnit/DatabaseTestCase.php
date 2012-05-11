<?php

abstract class PHPUnit_DatabaseTestCase extends Zend_Test_PHPUnit_DatabaseTestCase
{
    protected $_connection;

    /**
     * Returns connection
     *
     * @access protected
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        if ($this->_connection == null) {
            $config = Zend_Registry::get('Config')->resources;
            $connection = Zend_Db_Table::getDefaultAdapter();

            // uncomment this line if you have foreign keys on columns,
            // otherwise you won't be able to truncate table
            //$connection->query("SET foreign_key_checks = 0");

            $this->_connection = $this->createZendDbConnection($connection, $config->db->params->dbname);
        }

        return $this->_connection;
    }
}