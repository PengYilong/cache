<?php
include '../../Loader.php';
spl_autoload_register('Loader::_autoload');

define('DS', DIRECTORY_SEPARATOR);
define('SITE_PATH', dirname(realpath('../../Loader.php').DS ));

//load config
$config = include '../../config.php';

$fcache = new cache\File($config);
$fcache->s('demo',Array(1,2,3,4,5));
print_r($fcache->s('demo'));
$fcache->s('demo');
