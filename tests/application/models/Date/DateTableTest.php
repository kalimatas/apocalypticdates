<?php

class DateTableTest extends PHPUnit_DatabaseTestCase
{
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
    public function testWhetherNotHasHappened()
    {
        $happenedDates = $this->_table->fetchAll(
            $this->_table->select()
                ->where('happened = ?', 1)
        );

        $this->assertEquals($happenedDates->count(), 0);
    }
}