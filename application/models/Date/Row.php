<?php

/**
 * @property integer $happened
 */
class Apoc_Model_Date_Row extends Zend_Db_Table_Row_Abstract
{
    public function activate()
    {
        $this->happened = 1;
        $this->save();
    }
}