<?php

/**
 * 0 - no debug
 * 1 - output logging with Debug::output
 * 2 - output logging with Debug::output includes backtrace
 */
define('DEBUG_LEVEL',1);

//define the webroot
define ('WEBROOT','/');

//define the database settings
$dbParams = array(
    'host'     => '127.0.0.1',
    'username' => 'root',
    'password' => '',
    'dbname'   => '',
    'charset'  => 'utf8',
);

$db = Zend_Db::factory('Pdo_Mysql', $dbParams);