<?php

ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT_PATH . DS);

if (file_exists(APP_PATH . 'libs/FilterSecurity.php'))
    require_once APP_PATH . 'libs/FilterSecurity.php';

try {
    $filterSec = new FilterSecurity();
    $filterSec->validateRequest();
} catch (Exception $e) {
    echo $e->getMessage();
}