<?php
include './Loader.php';
spl_autoload_register('Cache\Loader::_autoload');

//load config
$config = include './config.php';

$Memcached = new driver\Memcached();
$Memcached->open($config);
$Memcached->s('name', array('1', '2'));
var_dump($Memcached->s('name'));