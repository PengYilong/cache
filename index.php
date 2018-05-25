<?php
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('SITE_PATH') or define('SITE_PATH', dirname(__FILE__).DS);

include './Loader.php';
spl_autoload_register('Loader::_autoload');

//load config
$config = include './config.php';

$Memcached = new cache\Memcached();
$Memcached->open($config);
$Memcached->s('name', array(1,2));
var_dump($Memcached->s('name'));