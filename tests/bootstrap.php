<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

defined('TESTS_PATH')
    || define('TESTS_PATH', realpath(dirname(__FILE__) . '/../tests'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

$configFile = APPLICATION_PATH . '/configs/application.ini';

$application = new Zend_Application(
    APPLICATION_ENV,
    $configFile
);
$application->bootstrap();

Zend_Registry::set('Config', new Zend_Config_Ini($configFile, APPLICATION_ENV, true));