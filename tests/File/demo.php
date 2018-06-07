<?php
include '../../Loader.php';
spl_autoload_register('Loader::_autoload');
use Nezumi\File;


//load config
$config = include '../../config.php';

$fcache = new File($config);
$fcache->s('demo',Array(1,2,3,4,5));
print_r($fcache->s('demo'));
$fcache->s('demo');
