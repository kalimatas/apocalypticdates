<?php

class DateTableTest extends PHPUnit_DatabaseTestCase
{
    /**
     * @var Apoc_Model_Date_Table
     */
    protected $_table;

    protected function setUp()
    {
        parent::setUp();
        $this->_table = new Apoc_Model_Date_Table();
    }

    protected function getDataSet()
    {
        $dataSet = new PHPUnit_Extensions_Database_DataSet_YamlDataSet(dirname(__FILE__) . '/_files/date.yml');
        return $dataSet;
    }

    /**
     * Should pass :))
     */
    public function testWhetherHasNotHappened()
    {
        $happenedDates = $this->_table->fetchAll(
            $this->_table->select()
                ->where('happened = ?', 1)
        );

        $this->assertEquals($happenedDates->count(), 0);
    }

    /**
     * Let's activate one date. No. We are not going to die.
     */
    public function testActivateAction()
    {
        /** @var $date Apoc_Model_Date_Row */
        $date = $this->_table->fetchRow('id = 2');
        $date->activate();

        // and compare with expected result
        $expectedDataSet = new PHPUnit_Extensions_Database_DataSet_YamlDataSet(dirname(__FILE__) . '/_files/date_after_activation.yml');
        $expectedTable = $expectedDataSet->getTable('date');

        $queryTable = $this->getConnection()->createQueryTable(
            'date', 'SELECT * FROM date'
        );

        $this->assertTablesEqual($expectedTable, $queryTable);
    }
}