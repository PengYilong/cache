<?php
include './Loader.php';
spl_autoload_register('Loader::_autoload');
use Nezumi\Memcached;

//load config
$config = include './config.php';

$Memcached = new cache\Memcached();
$Memcached->open($config);
$Memcached->s('name', array(1,2));
var_dump($Memcached->s('name'));