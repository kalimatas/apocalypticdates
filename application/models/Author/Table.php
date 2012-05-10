<?php
class Apoc_Model_Author_Table extends Zend_Db_Table_Abstract
{
    protected $_name = 'author';
    protected $_dependentTables = array('date');
}