<?php
error_reporting(E_ALL);
define('BASE_PATH', realpath(dirname(__FILE__)) . '/');
define('CACHE_PATH', BASE_PATH . "cache/");
define('SOURCE_PATH', BASE_PATH . "data/");
define('TEMPLATE_PATH', BASE_PATH . "template/");

$config = require_once BASE_PATH . 'config.php';
if($config['system']['debug']){
    ini_set('display_errors', 'on');
    ini_set('track_errors', true);
}

require_once BASE_PATH . '/app/Fantexi.php';
Fantexi::getInstance($config)->init();
