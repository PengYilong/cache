The PHP cache classes

[![Latest Stable Version](https://poser.pugx.org/yilongpeng/cache/v/stable)](https://packagist.org/packages/yilongpeng/cache)


## Installation

Use [composer](http://getcomposer.org) to install yilong/mysql in your project:
```
composer require yilongpeng/cache
```


## Usage
```php
use cache\Memcached;

//load config
$config = include './config.php';

$Memcached = new cache\Memcached();
$Memcached->open($config);
$Memcached->s('name', array(1,2));
$Memcached->s('name');
```


