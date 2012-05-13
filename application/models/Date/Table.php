<?php
class Apoc_Model_Date_Table extends Zend_Db_Table_Abstract
{
    protected $_name = 'date';
    protected $_rowClass = 'Apoc_Model_Date_Row';

    protected $_referenceMap    = array(
        'Authors' => array(
            'columns'           => 'author_id',
            'refTableClass'     => 'Apoc_Model_Author_Table',
            'refColumns'        => array('id'),
        ),
    );
}