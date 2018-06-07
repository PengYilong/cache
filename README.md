A PHP cache classes

## Installation

Use [composer](http://getcomposer.org) to install nezumi/mysql in your project:
```
composer require nezumi/cache
```


## Usage
```php
use nezumi\Memcached;

//load config
$config = include './config.php';

$Memcached = new Memcached();
$Memcached->open($config);
$Memcached->s('name', array(1,2));
$Memcached->s('name');
```


