<?php
$m = new Memcached();
$m->addServer('127.0.0.1', 11211);
// $m->set('num', 5, 0);
// echo $m->increment('num', 5);
$data = array(
	'key1' => 'value1',
	'key2' => 'value2'
);
$m->setMulti($data);
// $m->deleteMulti(array('key1','key2'));
echo $m->get('key1');
