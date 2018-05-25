<?php
return array (
	'type' => 'File',
	'cache_dir'=> './cache/',
	'debug' => true,
	'autoconnect' => 1,
	//memcached configuration
	// 'cache_server' 		=> 'memcached',
	// 'cache_host' 		=> 'localhost',
	// 'cache_port' 		=> '11211',
	// 'cache_time' 		=> 3600*24*30, 
    //redis configuration
    'cache_server' 		=> 'redis',
	'cache_host' 		=> '127.0.0.1',
	'cache_port' 		=> '6379',
	'cache_time' 		=> 3600, 
);
